<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe extends CI_Controller
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
        $this->load->model('equipe_model');
        $this->load->model('funcionario_model');
        $this->load->model('log_model');
        $this->load->database();
    }

    public function index($page = null)
    {
        if (empty($page)):
            $page = 0;
        endif;

        #LISTA TODAS EQUIPES
        $data['equipes'] = $this->equipe_model->list_team(null, $page);

        #LISTA OS TIPOS DE EQUIPE
        $data['tipoEquipes'] = $this->equipe_model->list_type_team();

        #PAGINADOR
        $config['base_url'] = base_url() . 'equipes';
        $config['total_rows'] = $this->equipe_model->list_team_qtd();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<li>';
        $config['full_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<a class="section-pagination">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $data['paginador'] = $this->pagination->create_links();

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('equipe/home', $data);
        $this->load->view('include/footer.php');
    }

    public function create_team()
    {
        #LISTA TODOS FUNCIONARIOS PARA CRIAR EQUIPE
        $data['funcionarios'] = $this->funcionario_model->list_employee_team();

        foreach ($data['funcionarios'] as $funcionario):
            if ($this->equipe_model->check_inspector_team($funcionario['id_funcionario']) < 1):
                $data['funcPermitidos'][] = $funcionario;
            endif;
        endforeach;

        #LISTA OS TIPOS DE EQUIPE
        $data['tipoEquipes'] = $this->equipe_model->list_type_team();

        #CRIAR EQUIPE
        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('equipe/criar-equipe.php', $data);
        $this->load->view('include/footer.php');
    }

    public function insert()
    {
        #INSERT EQUIPE
        if ($_POST):
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('nome_equipe', ' "Nome da equipe" ', 'required');
            $this->form_validation->set_rules('inspetor', ' "Inspetor" ', 'required');
            $this->form_validation->set_rules('tipo_equipe', ' "Tipo de quipe" ', 'required');

            #VERIFICA OS CAMPOS OBRIGATORIOS
            if ($this->form_validation->run() === FALSE):
                $this->create_team();
            else:
                #RECEBE OS VALORES ATRAVES DO POST
                $nomeEquipe = strip_tags(trim($this->input->post('nome_equipe')));
                $inspetor = strip_tags(trim($this->input->post('inspetor')));
                $observacao = strip_tags(trim($this->input->post('observacao')));
                $tipoEquipe = strip_tags(trim($this->input->post('tipo_equipe')));

                $data = array(
                    'nome_equipe' => $nomeEquipe,
                    'inspetor_equipe' => $inspetor,
                    'observacao_equipe' => $observacao,
                    'tipo_equipe' => $tipoEquipe,
                    'data_cad_equipe' => date('Y-m-d H:i:s')
                );

                #VERIFICA SE OCORREU O INSERT NO BANCO DE DADOS
                if ($this->equipe_model->register($data)):
                    $this->session->set_flashdata(open_modal(CADASTRO_SUCESSO, CLASSE_SUCESSO));
                    redirect(base_url('equipes'));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('cadastrar-equipe'));
                endif;
            endif;
        endif;
    }

    public function search()
    {

        $nome = strip_tags(trim($this->input->post('nome')));
        $tipoEquipe = strip_tags($this->input->post('tipo_equipe'));
        $status = $this->input->post('status');

        if (empty($nome) && empty($tipoEquipe)):
            $this->session->set_flashdata(open_modal('Ops, digite o nome ou tipo de equipe para realizar a consulta.', CLASSE_ERRO));
            redirect(base_url('equipes'));
        endif;

        #REALIZA A PESQUISA
        $data['equipes'] = $this->equipe_model->list_search($nome, $tipoEquipe, $status);

        #LISTA OS TIPOS DE EQUIPE
        $data['tipoEquipes'] = $this->equipe_model->list_type_team();

        #DADOS DA PESQUISA
        $data['nome'] = $nome;
        $data['tipo_equipe'] = $tipoEquipe;
        $data['status'] = $status;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('equipe/home', $data);
        $this->load->view('include/footer.php');
    }

    public function delete($id)
    {
        if (empty($id)):
            redirect(base_url('equipes'));
        endif;

        $data['status_equipe'] = "inativo";

        if ($this->equipe_model->delete($id, $data)):
            $this->session->set_flashdata(open_modal(DELETADO_SUCESSO, CLASSE_SUCESSO));
            redirect(base_url('equipes'));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('equipes'));
        endif;
    }

    public function delete_employee($id, $idEquipe)
    {


        if (empty($id)):
            redirect(base_url('gerenciar-equipe'));
        endif;

        if ($this->equipe_model->delete_employee($id)):
            $this->session->set_flashdata(open_modal(DELETADO_SUCESSO, CLASSE_SUCESSO));
            redirect(base_url('gerenciar-equipe/' . $idEquipe));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('gerenciar-equipe/' . $idEquipe));
        endif;
    }

    public function edit($id)
    {
        if (empty($id)):
            redirect(base_url('equipes'));
        endif;

        #LISTA TODOS FUNCIONARIOS PARA CRIAR EQUIPE
        $data['funcionarios'] = $this->funcionario_model->list_employee_team();


        #LISTA FUNCIONARIO PARA EDITAR
        $data['equipes'] = $this->equipe_model->list_team((int)$id, null);

        if (empty($data['equipes'])):
            redirect(base_url('equipes'));
        endif;

        #LISTA O FUNCIONARIO RESPONSAVEL PELA EQUIPE
        $data['funcPermitidos'] = $this->funcionario_model->list_employee($data['equipes'][0]['inspetor_equipe'], null);

        foreach ($data['funcionarios'] as $funcionario):
            if ($this->equipe_model->check_inspector_team($funcionario['id_funcionario']) < 1):
                $data['funcPermitidos'][] = $funcionario;
            endif;
        endforeach;


        #LISTA OS TIPOS DE QUIPE
        $data['tipoEquipes'] = $this->equipe_model->list_type_team();

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('equipe/editar-equipe', $data);
        $this->load->view('include/footer.php');
    }

    public function insert_edit()
    {
        if ($_POST):

            #ID PARA EDITAR
            $idEquipe = (int)$this->input->post('id_equipe');
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('nome_equipe', ' "Nome da equipe" ', 'required');
            $this->form_validation->set_rules('inspetor', ' "Inspetor" ', 'required');
            $this->form_validation->set_rules('tipo_equipe', ' "Tipo de quipe" ', 'required');

            #VERIFICA OS CAMPOS OBRIGATORIOS

            if ($this->form_validation->run() === FALSE):
                $this->edit($idEquipe);
            else:

                #RECEBE OS VALORES ATRAVES DO POST
                $nomeEquipe = strip_tags(trim($this->input->post('nome_equipe')));
                $inspetor = strip_tags(trim($this->input->post('inspetor')));
                $tipoEquipe = strip_tags(trim($this->input->post('tipo_equipe')));
                $status = strip_tags(trim($this->input->post('status')));
                $observacao = strip_tags(trim($this->input->post('observacao')));


                $data = array(
                    'nome_equipe' => $nomeEquipe,
                    'inspetor_equipe' => $inspetor,
                    'tipo_equipe' => $tipoEquipe,
                    'status_equipe' => $status,
                    'observacao_equipe' => $observacao,
                    'data_cad_equipe' => date('Y-m-d H:i:s')
                );

                #VERIFICA SE OCORREU O UPDATE NO BANCO DE DADOS
                if ($this->equipe_model->update($idEquipe, $data)):
                    $this->session->set_flashdata(open_modal(ALTERADO_SUCESSO, CLASSE_SUCESSO));
                    redirect(base_url('equipes'));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('editar-equipe/' . $idEquipe));
                endif;
            endif;
        endif;
    }

    public function manager_team($id)
    {
        if (empty($id)):
            redirect(base_url('equipes'));
        endif;

        #LISTA A EQUIPE PARA GERENCIAR
        $data['equipe'] = $this->equipe_model->list_team($id, null);

        $idInspetor = $data['equipe'][0]['inspetor_equipe'];

        #LISTA OS ENCANADORES
        $data['funcionarios'] = $this->equipe_model->list_employee_manager($idInspetor);

        #ENCANADORES EQUIPE
        $data['encanadores'] = $this->equipe_model->list_plumber_manager($id);

        if (empty($data['equipe'])):
            redirect(base_url('equipes'));
        endif;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('equipe/gerenciar-equipe', $data);
        $this->load->view('include/footer.php');

    }

    public function insert_manager_team()
    {
        if ($_POST):
            $idFuncionario = (int)$this->input->post('resultado-encanador');
            $idEquipe = (int)$this->input->post('equipe');

            #VERIFICA SE O FUNCIONARIO JÁ CONSTA NA EQUIPE
            $verificaFuncionario = $this->equipe_model->check_employee_team($idFuncionario);

            $data = array(
                'id_equipe' => $idEquipe,
                'id_funcionario' => $idFuncionario,
                'data_cad_func_equipe' => date('Y-m-d H:i:s')
            );

            if (count($verificaFuncionario) > 0):
                $nomeEquipe = $this->equipe_model->list_team((int)$verificaFuncionario['0']['id_equipe'], null);
                $this->session->set_flashdata(open_modal('Encanador já cadastrado na equipe ' . '<a href="'.base_url('gerenciar-equipe/').$nomeEquipe['0']['id_equipe'].'" >'.$nomeEquipe['0']['nome_equipe'].'</a>', CLASSE_ERRO));
                redirect(base_url('gerenciar-equipe/' . $idEquipe));
            endif;

            #VERIFICA SE OCORREU O INSERT NO BANCO DE DADOS
            if ($this->equipe_model->manager_team($data)):
                $this->session->set_flashdata(open_modal(CADASTRO_SUCESSO, CLASSE_SUCESSO));
                redirect(base_url('gerenciar-equipe/' . $idEquipe));
            else:
                $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                redirect(base_url('gerenciar-equipe/' . $idEquipe));
            endif;
        endif;
    }
}
