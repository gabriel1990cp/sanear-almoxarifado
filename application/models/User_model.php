<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model
{
    #CADASTRAR USUARIO
    function register($data)
    {
        return $this->db->insert('usuarios', $data);
    }

    #LISTA TODOS USUARIOS, LISTA O USUARIO PARA EDITAR
    function list_users($id = NULL,$page = NULL)
    {
        $this->db->select('x1.*,x2.nome_perfil');
        $this->db->from("usuarios x1");
        $this->db->join("perfil x2", 'x1.perfil_usuario = x2.id_perfil');
        if (!empty($id)):
            $this->db->where('x1.id_usuario', $id);
        endif;
        $this->db->limit(10,$page);
        $this->db->order_by('x1.status_usuario', "ASC");
        $this->db->order_by('x1.nome_usuario', "ASC");
        return $this->db->get()->result_array();
    }

    function list_users_qtd()
    {
        $this->db->select('*');
        $this->db->from("usuarios");
        return $this->db->get()->num_rows();
    }

    #VERIFICA SE O E-MAIL NOVO JÁ CONSTA NO SISTEMA
    function check_email($id = NULL,$email = NULL)
    {
        $this->db->select('*');
        $this->db->from("usuarios");
        $this->db->where('email_usuario', $email);
        if (!empty($id)):
            $this->db->where('id_usuario !=', $id);
        endif;
        return $this->db->get()->num_rows();
    }

    #VERIFICA SE A SENHA ANTIGA ESTA CORRETA
    function list_user_password($id = NULL, $senhaAtual = NULL)
    {
        $this->db->select('*');
        $this->db->from("usuarios");
        $this->db->where('senha_usuario', $senhaAtual);
        $this->db->where('id_usuario', $id);
        return $this->db->get()->num_rows();
    }

    #BUSCA DE USUARIO PELO CAMPO NOME, CPF, STATUS
    function list_search($nome = NULL, $cpf = NULL, $status = NULL)
    {
        $this->db->select('x1.*,x2.nome_perfil');
        $this->db->from("usuarios x1");
        $this->db->join("perfil x2", 'x1.perfil_usuario = x2.id_perfil');
        if (!empty($nome)):
            $this->db->like('x1.nome_usuario', $nome);
        endif;
        if (!empty($cpf)):
            $this->db->like('x1.cpf_usuario', $cpf);
        endif;
        if (!empty($status)):
            $this->db->where('x1.status_usuario', $status);
        endif;
        $this->db->order_by('x1.nome_usuario', "ASC");
        return $this->db->get()->result_array();
    }

    function delete($id, $data)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('usuarios', $data);
    }

    function update($id, $data)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('usuarios', $data);
    }
}

