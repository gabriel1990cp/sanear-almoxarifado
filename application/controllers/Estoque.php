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
        $this->load->model('funcionario_model');
        $this->load->model('estoque_model');
        $this->load->model('log_model');
        $this->load->database();
    }

    public function index($page = null)
    {
        if (empty($page)):
            $page = 0;
        endif;

        #LISTA TODOS FUNCIONARIOS
        $data['funcionarios'] = $this->funcionario_model->list_employee(null, $page);

        #PAGINADOR
        $config['base_url'] = base_url() . 'funcionarios';
        $config['total_rows'] = $this->funcionario_model->list_employee_qtd();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<li>';
        $config['full_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<a class="section-pagination">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $data['paginador'] = $this->pagination->create_links();

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('funcionario/home', $data);
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

                $data = array(
                    'atend_requisicao_entrada_est' => $atendiRequisicao,
                    'nota_remessa_entrada_est' => $notaRemessa,
                    'arquivo_entrada_est' => '',
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

    public function insert_material($idEntradaMaterial)
    {
        #ID ENTRADA MATERIAL
        $data['id_entrada_material'] = (int) $idEntradaMaterial;

        #LISTA OS MATERIAIS DA ENTRADA DO ESTOQUE
        $data['materiais'] = $this->estoque_model->list_material( (int) $idEntradaMaterial );

        #TIPO DE MATERIAL PARA CADASTRO
        $data['tipo_material'] = $this->estoque_model->list_type_material();

        #ENTRADA DE MATERIAL
        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('estoque/entrada-material', $data);
        $this->load->view('include/footer.php');


    }

    public function entrada_estoque_cxhm()
    {
        #RECEBE OS HM PARA INSERT
        $idEntradaMaterial = strip_tags(trim($this->input->post('id_entrada_material')));
        $tipoMaterial = strip_tags(trim($this->input->post('tipo_material')));
        $inicioCaixaHM = strip_tags(trim($this->input->post('inicio_caixa_hm')));
        $fimCaixaHM = strip_tags(trim($this->input->post('fim_caixa_hm')));

        #DEIXA APENAS OS NUMEROS DOS HM'S
        $anoModeloHM = substr($inicioCaixaHM, 0, 4);
        $inicioCaixaHMNumeros = substr($inicioCaixaHM, 4, 6);
        $fimCaixaHMNumeros = substr($fimCaixaHM, 4, 6);

        $diferencaHM = $fimCaixaHMNumeros - $inicioCaixaHMNumeros;


        $data = array(
            'id_entrada_estoque_caixa' => $idEntradaMaterial,
            'id_mat_estoque_caixa' => $tipoMaterial,
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

            redirect(base_url('entrada-material/' . $idEntradaMaterial));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));

        endif;

    }


    public function edit($id)
    {
        if (empty($id)):
            redirect(base_url('funcionarios'));
        endif;

        #LISTA TODOS OS CARROS
        $data['carros'] = $this->funcionario_model->list_car();

        #LISTA TODOS MATERIAIS PARA ENTRADA NO ESTOQUE
        $data['cargos'] = $this->funcionario_model->list_office();

        #LISTA FUNCIONARIO PARA EDITAR
        $data['funcionario'] = $this->funcionario_model->list_employee((int)$id, null);

        if (empty($data['funcionario'])):
            redirect(base_url('funcionarios'));
        endif;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('funcionario/editar-funcionario', $data);
        $this->load->view('include/footer.php');
    }

    public function view($id)
    {
        if (empty($page)):
            $page = 0;
        endif;

        #LISTA TODOS FUNCIONARIOS
        $data['funcionario'] = $this->funcionario_model->list_employee((int)$id, $page);

        if (empty($data['funcionario'])):
            redirect(base_url('funcionarios'));
        endif;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('funcionario/visualizar', $data);
        $this->load->view('include/footer.php');
    }

    public function search()
    {
        $nome = strip_tags(trim($this->input->post('nome')));
        $cpf = strip_tags($this->input->post('cpf'));
        $status = $this->input->post('status');

        if (empty($nome) && empty($cpf)):
            $this->session->set_flashdata(open_modal('Ops, digite o nome ou cpf para realizar a consulta.', CLASSE_ERRO));
            redirect(base_url('funcionario'));
        endif;

        #RESULTADO DA PESQUISA
        $data['funcionarios'] = $this->funcionario_model->list_search($nome, $cpf, $status);

        #DADOS DA PESQUISA
        $data['nome'] = $nome;
        $data['cpf'] = $cpf;
        $data['status'] = $status;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('funcionario/home', $data);
        $this->load->view('include/footer.php');
    }

    public function delete($id)
    {
        if (empty($id)):
            redirect(base_url('funcionarios'));
        endif;

        #SETA O USUARIO COMO INATIVO
        $data['status_funcionario'] = "inativo";

        #VERIFICA SE O STATUS FOI ALTERADO COM SUCESSO
        if ($this->funcionario_model->delete($id, $data)):
            $this->session->set_flashdata(open_modal(DELETADO_SUCESSO, CLASSE_SUCESSO));
            redirect(base_url('funcionarios'));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('funcionarios'));
        endif;
    }

    public function insert_edit()
    {
        if ($_POST):

            #ID PARA EDITAR
            $idFuncionario = (int)$this->input->post('id_funcionario');
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('nome', ' "Nome do funcionário" ', 'required');

            #VERIFICA OS CAMPOS OBRIGATORIOS

            if ($this->form_validation->run() === FALSE):
                $this->edit($idFuncionario);
            else:

                #RECEBE OS VALORES ATRAVES DO POST
                $nome = strip_tags(trim($this->input->post('nome')));
                $rg = strip_tags($this->input->post('rg'));
                $cpf = strip_tags($this->input->post('cpf'));
                $cargo = strip_tags(trim($this->input->post('cargo')));
                $telefone = strip_tags(trim($this->input->post('telefone')));
                $celular = strip_tags(trim($this->input->post('celular')));
                $carro = strip_tags(trim($this->input->post('carro')));
                $status = strip_tags(trim($this->input->post('status')));
                $observacao = strip_tags(trim($this->input->post('observacao')));

                $data = array(
                    'nome_funcionario' => $nome,
                    'rg_funcionario' => $rg,
                    'cpf_funcionario' => $cpf,
                    'cargo_funcionario' => $cargo,
                    'telefone_funcionario' => $telefone,
                    'celular_funcionario' => $celular,
                    'carro_funcionario' => $carro,
                    'observacao_funcionario' => $observacao,
                    'status_funcionario' => $status,
                    'data_atualizacao_funcionario' => date('Y-m-d H:i:s')
                );

                #VERIFICA SE OCORREU O UPDATE NO BANCO DE DADOS
                if ($this->funcionario_model->update($idFuncionario, $data)):
                    $this->session->set_flashdata(open_modal(ALTERADO_SUCESSO, CLASSE_SUCESSO));
                    redirect(base_url('funcionarios'));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('editar-funcionario/' . $idFuncionario));
                endif;
            endif;
        endif;
    }
}
