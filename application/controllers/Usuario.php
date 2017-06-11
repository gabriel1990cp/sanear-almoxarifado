<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
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
        $this->load->model('user_model');
        $this->load->model('log_model');
        $this->load->database();
    }

    public function index($page = null)
    {
        if (empty($page)):
            $page = 0;
        endif;

        #LISTA TODOS USUARIOS
        $data['usuarios'] = $this->user_model->list_users(null,$page);

        #PAGINADOR
        $config['base_url'] = base_url() . 'usuarios';
        $config['total_rows'] = $this->user_model->list_users_qtd();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<li>';
        $config['full_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<a class="section-pagination">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $data['paginador'] = $this->pagination->create_links();

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('usuario/home', $data);
        $this->load->view('include/footer.php');
    }

    public function create_user()
    {
        #CRIAR USUARIO

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('usuario/criar-usuario');
        $this->load->view('include/footer.php');
    }

    public function insert()
    {
        #INSERT USUARIO
        if ($_POST):
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('nome', ' "Nome do cliente" ', 'required');
            $this->form_validation->set_rules('email', ' "Email" ', 'required');
            $this->form_validation->set_rules('conf_email', ' "Confirmar E-mail" ', 'required');
            $this->form_validation->set_rules('perfil', ' "Perfil" ', 'required');
            $this->form_validation->set_rules('senha', ' "Senha" ', 'required');
            $this->form_validation->set_rules('conf_senha', ' "Confirmar Senha" ', 'required');

            #VERIFICA OS CAMPOS OBRIGATORIOS

            if ($this->form_validation->run() === FALSE):
                $this->create_user();
            else:
                #RECEBE OS VALORES ATRAVES DO POST
                $nome = strip_tags(trim($this->input->post('nome')));
                $rg = strip_tags($this->input->post('rg'));
                $cpf = strip_tags($this->input->post('cpf'));
                $email = strip_tags(trim($this->input->post('email')));
                $confEmail = strip_tags(trim($this->input->post('conf_email')));
                $matSanear = strip_tags(trim($this->input->post('mat_sanear')));
                $perfil = (int)strip_tags($this->input->post('perfil'));
                $senha = strip_tags($this->input->post('senha'));
                $confSenha = strip_tags($this->input->post('conf_senha'));


                #VERIFICAR SE O EMAIL E O CONF EMAIL SÃO IGUAIS
                if (strcmp($email, $confEmail) != 0):
                    $this->session->set_flashdata(open_modal('Ops, o campo e-mail e confirmar e-mail devem ser iguais.', CLASSE_ERRO));
                    redirect(base_url('cadastrar-usuario'));
                endif;

                #VERIFICAR SE O SENHA E O CONF SÃO IGUAIS
                if (strcmp($senha, $confSenha) != 0):
                    $this->session->set_flashdata(open_modal('Ops, o campo senha e confirmar senha devem ser iguais.', CLASSE_ERRO));
                    redirect(base_url('cadastrar-usuario'));
                endif;

                #VERIFICAR QUANTIDADE DE CARACTERES DA SENHA
                if (strlen($senha) < 8):
                    $this->session->set_flashdata(open_modal('Ops, Insira pelo menos 8 caracteres.', CLASSE_ERRO));
                    redirect(base_url('cadastrar-usuario'));
                endif;

                #VERIFICAR SE JÁ CONSTA O E-MAIL CADASTRADO NO BANCO DE DADOS
                $verificaEmail = $this->user_model->check_email(null, $email);

                if ($verificaEmail > 0):
                    $this->session->set_flashdata(open_modal('Ops, o email ' . $email . ' já esta cadastrado.', CLASSE_ERRO));
                    redirect(base_url('cadastrar-usuario'));
                endif;

                $data = array(
                    'nome_usuario' => $nome,
                    'rg_usuario' => $rg,
                    'cpf_usuario' => $cpf,
                    'email_usuario' => $email,
                    'matricula_usuario' => $matSanear,
                    'perfil_usuario' => $perfil,
                    'senha_usuario' => md5($senha),
                    'data_cad_usuario' => date('Y-m-d H:i:s')
                );

                #VERIFICA SE OCORREU O INSERT NO BANCO DE DADOS
                if ($this->user_model->register($data)):
                    $this->session->set_flashdata(open_modal(CADASTRO_SUCESSO, CLASSE_SUCESSO));
                    redirect(base_url('usuarios'));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('cadastrar-usuario'));
                endif;
            endif;
        endif;
    }

    public function search()
    {
        $nome = strip_tags(trim($this->input->post('nome')));
        $cpf = strip_tags($this->input->post('cpf'));
        $status = $this->input->post('status');

        if (empty($nome) && empty($cpf)):
            $this->session->set_flashdata(open_modal('Ops, digite o nome ou cpf para realizar a consulta.', CLASSE_ERRO));
            redirect(base_url('usuario'));
        endif;

        #REALIZA A PESQUISA
        $data['usuarios'] = $this->user_model->list_search($nome, $cpf, $status);

        #DADOS DA PESQUISA
        $data['nome'] = $nome;
        $data['cpf'] = $cpf;
        $data['status'] = $status;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('usuario/home', $data);
        $this->load->view('include/footer.php');
    }

    public function delete($id)
    {
        if (empty($id)):
            redirect(base_url('usuarios'));
        endif;

        $data['status_usuario'] = "inativo";

        if ($this->user_model->delete($id, $data)):
            $this->session->set_flashdata(open_modal(DELETADO_SUCESSO, CLASSE_SUCESSO));
            redirect(base_url('usuarios'));
        else:
            $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
            redirect(base_url('usuarios'));
        endif;
    }

    public function edit($id)
    {
        if (empty($id)):
            redirect(base_url('usuarios'));
        endif;

        #LISTA USUARIO PARA EDITAR
        $data['usuarios'] = $this->user_model->list_users((int)$id);

        if (empty($data['usuarios'])):
            redirect(base_url('usuarios'));
        endif;

        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
        $this->load->view('usuario/editar-usuario', $data);
        $this->load->view('include/footer.php');
    }

    public function insert_edit()
    {
        if ($_POST):

            #ID PARA EDITAR
            $idUusuario = (int)$this->input->post('id_usuario');

            #REALIZA AS VALIDAÇÕES
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('nome', ' "Nome do cliente" ', 'required');
            $this->form_validation->set_rules('email', ' "Email" ', 'required');
            $this->form_validation->set_rules('conf_email', ' "Confirmar E-mail" ', 'required');
            $this->form_validation->set_rules('perfil', ' "Perfil" ', 'required');

            if ($this->form_validation->run() === FALSE):
                $this->edit($idUusuario);
            else:

                #RECEBE OS VALORES ATRAVES DO POST
                $id = (int)$this->input->post('id_usuario');
                $nome = strip_tags(trim($this->input->post('nome')));
                $rg = strip_tags($this->input->post('rg'));
                $cpf = strip_tags($this->input->post('cpf'));
                $email = strip_tags(trim($this->input->post('email')));
                $confEmail = strip_tags(trim($this->input->post('conf_email')));
                $matSanear = strip_tags(trim($this->input->post('mat_sanear')));
                $perfil = strip_tags($this->input->post('perfil'));
                $senhaAtual = strip_tags($this->input->post('senha_atual'));
                $senha = strip_tags($this->input->post('senha'));
                $confSenha = strip_tags($this->input->post('conf_senha'));
                $status = strip_tags($this->input->post('status'));


                #VERIFICAR SE O EMAIL E O CONF EMAIL SÃO IGUAIS
                if (strcmp($email, $confEmail) != 0):
                    $this->session->set_flashdata(open_modal('Ops, o campo e-mail e confirmar e-mail devem ser iguais.', CLASSE_ERRO));
                    redirect(base_url('editar-usuario/' . $idUusuario));
                endif;

                #VERIFICAR SE O SENHA E O CONF SENHA É IGUAL
                if ($senha != $confSenha):
                    $this->session->set_flashdata(open_modal('Ops, o campo senha e confirmar senha devem ser iguais.', CLASSE_ERRO));
                    redirect(base_url('editar-usuario/' . $idUusuario));
                endif;

                #VERIFICA SE O E-MAIL NOVO JÁ CONSTA NO SISTEMA
                $verificaEmail = $this->user_model->check_email($id, $email);

                if (!empty($verificaEmail)):
                    $this->session->set_flashdata(open_modal('Ops, o email ' . $email . ' já esta cadastrado.', CLASSE_ERRO));
                    redirect(base_url('editar-usuario/' . $idUusuario));
                endif;

                #VERIFICA SE A SENHA ANTIGA ESTA CORRETA
                if (!empty($senhaAtual) && !empty($senha)):

                    #VERIFICAR QUANTIDADE DE CARACTERES DA SENHA
                    if (strlen($senha) < 8):
                        $this->session->set_flashdata(open_modal('Ops, Insira pelo menos 8 caracteres.', CLASSE_ERRO));
                        redirect(base_url('editar-usuario/' . $idUusuario));
                    endif;

                    $verificaSenha = $this->user_model->list_user_password($id, md5($senhaAtual));

                    if ($verificaSenha != 1):
                        $this->session->set_flashdata(open_modal('Ops, Verifique a senha antiga !', CLASSE_ERRO));
                        redirect(base_url('editar-usuario/' . $idUusuario));
                    endif;
                endif;

                $data = array(
                    'nome_usuario' => $nome,
                    'rg_usuario' => $rg,
                    'cpf_usuario' => $cpf,
                    'email_usuario' => $email,
                    'matricula_usuario' => $matSanear,
                    'perfil_usuario' => $perfil,
                    'status_usuario' => $status,
                    'data_atualizacao_usuario' => date('Y-m-d H:i:s')
                );

                if ($verificaSenha == 1):
                    $data['senha_usuario'] = md5($senha);
                endif;

                #VERIFICA SE OCORREU O UPDATE NO BANCO DE DADOS
                if ($this->user_model->update($idUusuario, $data)):
                    $this->session->set_flashdata(open_modal(ALTERADO_SUCESSO, CLASSE_SUCESSO));
                    redirect(base_url('usuarios'));
                else:
                    $this->session->set_flashdata(open_modal(MENSAGEM_ERRO, CLASSE_ERRO));
                    redirect(base_url('editar-usuario/' . $idUusuario));
                endif;
            endif;
        endif;
    }
}
