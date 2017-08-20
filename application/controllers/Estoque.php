<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        #CARREGA A LIBRARY'S
        $this->load->library('form_validation');
        $this->load->library('pagination');

        #CARREGA A HELPER'S
        $this->load->helper('modal_helper');

        #CARREGA MODEL'S
        $this->load->model('estoque_model');
        $this->load->model('log_model');
        $this->load->database();
    }

    public function index($page = null)
    {
        if (empty($page)):
            $page = 0;
        endif;

        #LISTA TODOS MATERIAIS
        $data['entradasEstoque'] = $this->estoque_model->list_material(null, $page);

        #PAGINADOR
        $config['base_url'] = base_url() . 'estoque';
        $config['total_rows'] = $this->estoque_model->list_material_qtd();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<li>';
        $config['full_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<a class="section-pagination">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $data['paginador'] = $this->pagination->create_links();

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/home', $data);
        $this->load->view('include/footer.php');
    }

    public function create_stock()
    {
        #ENTRADA ESTOQUE
        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/entrada-estoque');
        $this->load->view('include/footer.php');
    }

    public function insert()
    {
        #INSERIR ENTRADA NO ESTOQUE
        if ($_POST):
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('atendimento_requisicao', ' "Atendimento de Requisição" ', 'required');
            $this->form_validation->set_rules('nota_remessa', ' "Nota de remessa" ', 'required');

            #VERIFICA OS CAMPOS OBRIGATORIOS
            if ($this->form_validation->run() === FALSE):
                $this->create_stock();
            else:
                #RECEBE OS VALORES ATRAVES DO POST
                $notaRemessa = strip_tags(trim($this->input->post('nota_remessa')));
                $atendiRequisicao = strip_tags($this->input->post('atendimento_requisicao'));

                #VERIFICA SE JÁ EXISTE UMA NOTA CADASTRADA
                $verificaNotaRemessa = $this->estoque_model->check_nota_remessa($notaRemessa);

                if ($verificaNotaRemessa > 0) {
                    $this->session->set_flashdata(open_modal('Nota de remessa já cadastrada !', CLASSE_ERRO));
                    redirect(base_url('estoque/index'));
                }

                #LIBRARY PARA REALIZAR O UPLOAD
                $this->load->library('upload');

                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'pdf';
                $config['max_width'] = '500';
                $config['overwrite'] = 'true';
                $config['encrypt_name'] = false;
                $config['file_name'] = $notaRemessa;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('arquivo')):
                    $erro = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata(open_modal($erro['error'], CLASSE_ERRO));
                    redirect(base_url('estoque-entrada'));
                else:
                    $imagem['arquivo'] = $this->upload->data();
                endif;

                $data = array(
                    'atend_requisicao_entrada_est' => $atendiRequisicao,
                    'nota_remessa_entrada_est' => $notaRemessa,
                    'arquivo_entrada_est' => $imagem['arquivo']['file_name'],
                    'responsavel_entrada_est' => '1',
                    'status_entrada_est' => 'aberto',
                    'data_entrada_est' => date('Y-m-d H:i:s')
                );

                #VERIFICA SE O OCORREU O INSERT NO BANCO DE DADOS
                $idEntradaMaterial = $this->estoque_model->register($data);

                if (isset($idEntradaMaterial)):
                    $this->session->set_flashdata(open_modal('Entrada no estoque gerada com sucesso !', CLASSE_SUCESSO));
                    #REDIRICIONA PARA A ENTRADA DE MATERIAL
                    redirect(base_url('entrada-material/' . $idEntradaMaterial));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('estoque-entrada'));
                endif;
            endif;
        endif;
    }

    public function select_material($idEntradaMaterial, $material)
    {
        $data['idEntradaMaterial'] = $idEntradaMaterial;
        $data['idMaterial'] = $material;

        $data['infoEntradaMaterialView'] = $this->estoque_model->list_material($idEntradaMaterial, null);

        #INFO ENTRADA MATERIAL
        $data['infoEntradaMaterial'] = $this->load->view('estoque/info_entrada_material', $data, TRUE);

        #LISTA TODOS MATERIAIS PARA A ENTRADA
        $data['materiais'] = $this->list_material($idEntradaMaterial);

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');

        switch ($material) {
            case HIDROMETRO_A:
            case HIDROMETRO_B:
            case HIDROMETRO_C:
            case HIDROMETRO_D:
                $this->load->view('estoque/tipo_material/material_hm', $data);
                break;
            case HIDROMETRO_Y:
                $this->load->view('estoque/tipo_material/material_hmy', $data);
                break;
        }

        $this->load->view('include/footer.php');
    }

    public function combo_material()
    {
        #TIPO DE MATERIAL PARA CADASTRO
        return $this->estoque_model->list_type_material();
    }

    public function list_material($idEntradaMaterial)
    {
        #LISTA OS MATERIAIS REFERENTE A ENTRADA
        return $this->estoque_model->list_material_input((int)$idEntradaMaterial);
    }

    public function insert_material($idEntradaMaterial)
    {
        #ID ENTRADA MATERIAL
        $data['idEntradaMaterial'] = (int)$idEntradaMaterial;

        #LISTA OS MATERIAIS REFERENTE A ENTRADA
        $data['materiasEntrada'] = $this->list_material($idEntradaMaterial);

        #TIPO DE MATERIAL PARA CADASTRO
        $data['materiais'] = $this->combo_material();

        $data['infoEntradaMaterialView'] = $this->estoque_model->list_material($idEntradaMaterial, null);

        #INFO ENTRADA MATERIAL
        $data['infoEntradaMaterial'] = $this->load->view('estoque/info_entrada_material', $data, TRUE);

        #ENTRADA DE MATERIAL
        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/selecionar-material', $data);
        $this->load->view('include/footer.php');
    }

    public function entrada_tipo_material()
    {
        $idEntradaMaterial = (int)$this->input->post('id_entrada_material');
        $tipoMaterial = (int)$this->input->post('tipo_material');

        $data['id_entrada_material'] = $idEntradaMaterial;
        $data['id_material'] = $tipoMaterial;

        #TIPO DE MATERIAL PARA CADASTRO
        $data['tipo_material'] = $this->combo_material();

        #LISTA OS MATERIAIS REFERENTE A ENTRADA
        $data['materiais'] = $this->list_material($idEntradaMaterial);

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/entrada-material', $data);
    }


    public function entrada_estoque_cxhm()
    {

        #RECEBE OS HM PARA INSERT
        $idEntradaMaterial = strip_tags(trim($this->input->post('idEntradaMaterial')));
        $idMaterial = strip_tags(trim($this->input->post('idMaterial')));

        $inicioCaixaHM = strip_tags(trim($this->input->post('inicio_caixa_hm')));
        $fimCaixaHM = strip_tags(trim($this->input->post('fim_caixa_hm')));

        #DEIXA APENAS OS NUMEROS DOS HM'S
        $anoModeloHM = substr($inicioCaixaHM, 0, 4);
        $inicioCaixaHMNumeros = substr($inicioCaixaHM, 4, 6);
        $fimCaixaHMNumeros = substr($fimCaixaHM, 4, 6);

        $diferencaHM = $fimCaixaHMNumeros - $inicioCaixaHMNumeros;

        $data = array(
            'id_entrada_estoque_caixa' => $idEntradaMaterial,
            'id_mat_estoque_caixa' => $idMaterial,
            'quant_estoque_caixa' => $diferencaHM,
            'inicio_estoque_caixa' => $inicioCaixaHM,
            'fim_estoque_caixa' => $fimCaixaHM,
            'id_responsavel_estoque_caixa' => '1',
            'data_cadastro_estoque_caixa' => date('Y-m-d H:i:s')
        );

        $idCaixaEntrada = $this->estoque_model->register_material($data);

        #VERIFICA SE INSERIU A CAIXA E INSERE OS ITENS DA CAIXA
        if (isset($idCaixaEntrada)):

            for ($i = 0; $i <= $diferencaHM; $i++):

                $hmInsert = $inicioCaixaHMNumeros + $i;

                $data = array(
                    'id_caixa_estoque_itens_caixa' => $idCaixaEntrada,
                    'item_estoque_itens_caixa' => $anoModeloHM . $hmInsert,
                    'responsavel_estoque_itens_caixa' => '1',
                    'data_estoque_itens_caixa' => date('Y-m-d H:i:s')
                );

                $this->estoque_model->register_material_item($data);
            endfor;
            $this->session->set_flashdata(open_modal('Hidrômetro cadastrado com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
        endif;
    }
}
