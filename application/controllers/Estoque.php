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
                    'atend_requisicao_est_entrada' => $atendiRequisicao,
                    'nota_remessa_est_entrada' => $notaRemessa,
                    'arquivo_est_entrada' => $imagem['arquivo']['file_name'],
                    'responsavel_est_entrada' => '1',
                    'status_est_entrada' => 'aberto',
                    'data_est_entrada' => date('Y-m-d H:i:s')
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

        #NOME DO MATERIAL SELECIONADO
        $data['nomeMaterial'] = $this->estoque_model->name_material($material);

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');

        switch ($material) {
            case HIDROMETRO_A:
            case HIDROMETRO_B:
            case HIDROMETRO_C:
            case HIDROMETRO_D:
                #LISTA TODOS MATERIAIS PARA A ENTRADA
                $data['materiais'] = $this->estoque_model->list_material_input_hm((int)$idEntradaMaterial, $material);
                $this->load->view('estoque/tipo_material/material_hm', $data);
                break;

            case HIDROMETRO_Y:
                #LISTA TODOS MATERIAIS PARA A ENTRADA
                $data['materiais'] = $this->estoque_model->list_material_input_hmy((int)$idEntradaMaterial);
                $this->load->view('estoque/tipo_material/material_hmy', $data);
                break;

            case LACRE_CORDOALHA_ACO:
                $data['materiais'] = $this->estoque_model->list_material_input_hmy((int)$idEntradaMaterial);
                $this->load->view('estoque/tipo_material/material_lacre', $data);
                break;
        }

        $this->load->view('include/footer.php');
    }

    public function combo_material()
    {
        #TIPO DE MATERIAL PARA CADASTRO
        return $this->estoque_model->list_type_material();
    }

    public function insert_material($idEntradaMaterial)
    {
        #ID ENTRADA MATERIAL
        $data['idEntradaMaterial'] = (int)$idEntradaMaterial;

        #LISTA OS MATERIAIS REFERENTE A ENTRADA
        $data['materiasEntrada'] = $this->estoque_model->list_material_input_hmy((int)$idEntradaMaterial);

        #TIPO DE MATERIAL PARA CADASTRO
        $data['materiais'] = $this->combo_material();

        $data['infoEntradaMaterialView'] = $this->estoque_model->list_material($idEntradaMaterial, null);

        #INFO ENTRADA MATERIAL
        $data['infoEntradaMaterial'] = $this->load->view('estoque/info_entrada_material', $data, TRUE);

        #QUANTIDADE DE MATERIAS PARA A ENTRADA EM ABERTO
        #foreach ($data['materiais'] as $row):
#
        #    switch ($row['id_tipo_material']) {
        #        case HIDROMETRO_A:
        #        case HIDROMETRO_B:
        #        case HIDROMETRO_C:
        #        case HIDROMETRO_D:
        #            #LISTA TODOS MATERIAIS PARA A ENTRADA
        #            $quantMaterialEntrada[$row['$idEntradaMaterial']] = $this->estoque_model->count_input_hmy($idEntradaMaterial, $row['$idEntradaMaterial']);
        #            break;
#
        #        case HIDROMETRO_Y:
        #            #LISTA TODOS MATERIAIS PARA A ENTRADA
#
        #            break;
        #    }
#
        #endforeach;

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
        $data['materiais'] = $this->estoque_model->list_material_input_hmy((int)$idEntradaMaterial);

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/entrada-material', $data);
    }

    public function caixa_hmy()
    {
        $idCaixaHMY = (int)$this->input->post('caixa_hm');

        $caixaHMY = $this->estoque_model->view_caixa_hmy($idCaixaHMY);

        $listaHMY = '';

        foreach ($caixaHMY as $hmy):
            $listaHMY .= '<p>' . $hmy['item_est_caixa_hmy_itens'] . '</p>';
        endforeach;

        echo $listaHMY;
    }

    public function search()
    {
        $atendimentoRequisicao = strip_tags(trim($this->input->post('atendimento_requisicao')));
        $notaRemessa = strip_tags($this->input->post('nota_remessa'));
        $status = $this->input->post('status');

        if (empty($atendimentoRequisicao) && empty($notaRemessa)):
            $this->session->set_flashdata(open_modal('Ops, digite o Atendimento de Requisição ou a Nota de remessa para realizar a consulta.', CLASSE_ERRO));
            redirect(base_url('estoque'));
        endif;

        #RESULTADO DA PESQUISA
        $data['entradasEstoque'] = $this->estoque_model->list_search($atendimentoRequisicao, $notaRemessa, $status);

        #DADOS DA PESQUISA
        $data['atendimentoRequisicao'] = $atendimentoRequisicao;
        $data['notaRemessa'] = $notaRemessa;
        $data['status'] = $status;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/home', $data);
        $this->load->view('include/footer.php');
    }


    public function delete_caixa_hmy($idCaixaHMY, $idEntradaMaterial, $idMaterial)
    {
        $deletarCaixaHMY = $this->estoque_model->delete_caixa_hmy($idCaixaHMY);

        if ($deletarCaixaHMY == true):
            $this->session->set_flashdata(open_modal('Caixa de Hidrômetro deletada com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;
    }

    public function delete_caixa_hm_avulso($idHM, $idEntradaMaterial, $idMaterial)
    {
        $deletarCaixaHMY = $this->estoque_model->delete_caixa_hm_avulso($idHM);

        if ($deletarCaixaHMY == true):
            $this->session->set_flashdata(open_modal('Caixa de Hidrômetro deletada com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;
    }

    public function entrada_estoque_cxhm()
    {
        #RECEBE OS HM PARA INSERT
        $idEntradaMaterial = strip_tags(trim($this->input->post('idEntradaMaterial')));
        $idMaterial = strip_tags(trim($this->input->post('idMaterial')));

        $inicioCaixaHM = strip_tags(trim(strtoupper($this->input->post('inicio_caixa_hm'))));
        $fimCaixaHM = strip_tags(trim(strtoupper($this->input->post('fim_caixa_hm'))));

        # VERIFICA A NUMERAÇÃO DOS HIDROMETROS
        if (!preg_match(PREG_HIDROMETRO, $inicioCaixaHM) || !preg_match(PREG_HIDROMETRO, $fimCaixaHM)) :
            $this->session->set_flashdata(open_modal('Ops, verique os hidrometrô(s) cadastrado(s)', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
        if (empty($inicioCaixaHM) || empty($fimCaixaHM)):
            $this->session->set_flashdata(open_modal('Ops, é obrigatório preencher o "início caixa" ou "fim caixa"', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA A QUANTIDADE MINIMA DE 10 DIGITOS PARA O HM
        if (strlen($inicioCaixaHM) < 10 || strlen($fimCaixaHM) < 10):
            $this->session->set_flashdata(open_modal('Ops, verique os hidrometrô(s) cadastrado(s)', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # DEIXA APENAS OS NUMEROS DOS HM'S
        $anoModeloHMInicio = substr($inicioCaixaHM, 0, 4);
        $anoModeloHMFim = substr($fimCaixaHM, 0, 4);

        $inicioCaixaHMNumeros = substr($inicioCaixaHM, 4, 6);
        $fimCaixaHMNumeros = substr($fimCaixaHM, 4, 6);

        $diferencaHM = $fimCaixaHMNumeros - $inicioCaixaHMNumeros;

        # VERIFICA SE O ANO/MODELO DO HIDROMETRO ESTÁ CERTO
        if ($anoModeloHMInicio != $anoModeloHMFim):
            $this->session->set_flashdata(open_modal('Ops, ano/modelo incorreto', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA DE A DIFERENÇA DE HM É MUITO ALTA
        if ($diferencaHM > QTD_CAIXA_HM || $diferencaHM < 10):
            $this->session->set_flashdata(open_modal('Ops, quantidade ' . $diferencaHM . ' de hidrômetros acima ou abaixo do permitido.', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA SE O HM JÁ FOI CADASTRADO
        $verificaHMCadastrado = $this->estoque_model->check_hmy_table($inicioCaixaHM, $fimCaixaHM);

        if (!empty($verificaHMCadastrado)):
            $this->session->set_flashdata(open_modal('Ops, caixa de hidrômetros já cadastrada.', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        $data = array(
            'id_entrada_est_caixa_hmy' => $idEntradaMaterial,
            'id_mat_est_caixa_hmy' => $idMaterial,
            'quant_est_caixa_hmy' => $diferencaHM,
            'inicio_est_caixa_hmy' => $inicioCaixaHM,
            'fim_est_caixa_hmy' => $fimCaixaHM,
            'id_resp_est_caixa_hmy' => '1',
            'data_cad_est_caixa_hmy' => date('Y-m-d H:i:s')
        );

        $idCaixaEntrada = $this->estoque_model->insert_hmy($data);

        #VERIFICA SE INSERIU A CAIXA E INSERE OS ITENS DA CAIXA
        if (isset($idCaixaEntrada)):

            for ($i = 0; $i <= $diferencaHM; $i++):

                $hmInsert = $inicioCaixaHMNumeros + $i;

                $data = array(
                    'id_caixa_est_caixa_hmy_itens' => $idCaixaEntrada,
                    'item_est_caixa_hmy_itens' => $anoModeloHMInicio . $hmInsert,
                    'responsavel_est_caixa_hmy_itens' => '1',
                    'data_est_caixa_hmy_itens' => date('Y-m-d H:i:s')
                );

                $this->estoque_model->insert_hmy_item($data);
            endfor;
            $this->session->set_flashdata(open_modal('Hidrômetro cadastrado com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;
    }


    public function cadastrar_lacre()
    {
        #RECEBE OS LACRES PARA INSERT
        $idEntradaMaterial = strip_tags(trim($this->input->post('idEntradaMaterial')));
        $idMaterial = strip_tags(trim($this->input->post('idMaterial')));

        $inicioPacote = strip_tags(trim($this->input->post('inicio_pacote_lacre')));
        $fimPacote = strip_tags(trim($this->input->post('fim_pacote_lacre')));

        # VERIFICA A NUMERAÇÃO DOS LACRES
        if (!preg_match(PREG_HIDROMETRO, $inicioPacote) || !preg_match(PREG_HIDROMETRO, $fimPacote)) :
            $this->session->set_flashdata(open_modal('Ops, verique os lacres', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA SE OS CAMPOS FORAM PREENCHIDOS
        if (empty($inicioPacote) || empty($fimPacote)):
            $this->session->set_flashdata(open_modal('Ops, é obrigatório preencher o "início pacote" ou "fim pacote"', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA A QUANTIDADE MINIMA DE 6 DIGITOS PARA OS LACRES
        if (strlen($inicioPacote) < 6 || strlen($fimPacote) < 6):
            $this->session->set_flashdata(open_modal('Ops, verique os lacres', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA DE A DIFERENÇA DE HM É MUITO ALTA

        $diferencaPacote = $fimPacote - $inicioPacote;

        if ($diferencaPacote > QTD_PC_LACRE || $diferencaPacote < 10):
            $this->session->set_flashdata(open_modal('Ops, quantidade ' . $diferencaPacote . ' de lacres acima ou abaixo do permitido.', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA SE O HM JÁ FOI CADASTRADO
        $verificaLacreCadastrado = $this->estoque_model->check_lacre_table($inicioPacote, $fimPacote);

        if (!empty($verificaLacreCadastrado)):
            $this->session->set_flashdata(open_modal('Ops, pacote de lacre já cadastrado.', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        $data = array(
            'id_entrada_est_caixa_hmy' => $idEntradaMaterial,
            'id_mat_est_caixa_hmy' => $idMaterial,
            'quant_est_caixa_hmy' => $diferencaHM,
            'inicio_est_caixa_hmy' => $inicioCaixaHM,
            'fim_est_caixa_hmy' => $fimCaixaHM,
            'id_resp_est_caixa_hmy' => '1',
            'data_cad_est_caixa_hmy' => date('Y-m-d H:i:s')
        );

        $idCaixaEntrada = $this->estoque_model->insert_hmy($data);

        #VERIFICA SE INSERIU A CAIXA E INSERE OS ITENS DA CAIXA
        if (isset($idCaixaEntrada)):

            for ($i = 0; $i <= $diferencaHM; $i++):

                $hmInsert = $inicioCaixaHMNumeros + $i;

                $data = array(
                    'id_caixa_est_caixa_hmy_itens' => $idCaixaEntrada,
                    'item_est_caixa_hmy_itens' => $anoModeloHMInicio . $hmInsert,
                    'responsavel_est_caixa_hmy_itens' => '1',
                    'data_est_caixa_hmy_itens' => date('Y-m-d H:i:s')
                );

                $this->estoque_model->insert_hmy_item($data);
            endfor;
            $this->session->set_flashdata(open_modal('Hidrômetro cadastrado com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;
    }

    public function entrada_estoque_hm()
    {
        #RECEBE O HM PARA INSERT
        $idEntradaMaterial = strip_tags(trim($this->input->post('idEntradaMaterial')));
        $idMaterial = strip_tags(trim($this->input->post('idMaterial')));

        $hmAvulso = strip_tags(trim(strtoupper($this->input->post('hm_avulso'))));

        # VERIFICA SE O HIDROMETRO FOI PREENCHIDO
        if (empty($hmAvulso)):
            $this->session->set_flashdata(open_modal('Ops, é obrigatório preencher o hidrômetro', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA SE O HM JÁ FOI CADASTRADO
        $verificaHMCadastrado = $this->estoque_model->check_hm_table($hmAvulso);

        if (!empty($verificaHMCadastrado)):
            $this->session->set_flashdata(open_modal('Ops, hidrômetros já cadastrado.', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        # VERIFICA A QUANTIDADE MINIMA DE 10 DIGITOS PARA O HM
        if (strlen($hmAvulso) < 6 || strlen($hmAvulso) > 10):
            $this->session->set_flashdata(open_modal('Ops, verique se o hidrometrô está correto', CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;

        $data = array(
            'id_entrada_est_hm_avulso' => $idEntradaMaterial,
            'id_mat_est_hm_avulso' => $idMaterial,
            'numero_est_hm_avulso' => $hmAvulso,
            'id_resp_est_hm_avulso' => '1',
            'data_cad_est_hm_avulso' => date('Y-m-d H:i:s')
        );

        #VERIFICA SE INSERIU A CAIXA E INSERE OS ITENS DA CAIXA
        if ($this->estoque_model->insert_hm_avulso($data)):
            $this->session->set_flashdata(open_modal('Hidrômetro cadastrado com sucesso !', CLASSE_SUCESSO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $idMaterial));
        endif;
    }
}