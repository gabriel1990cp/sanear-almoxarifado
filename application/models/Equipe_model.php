<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Equipe_model extends CI_Model
{
    #CADASTRAR USUARIO
    function register($data)
    {
        return $this->db->insert('equipes', $data);
    }

    function manager_team($data)
    {
        return $this->db->insert('equipe_funcionarios', $data);
    }

    #LISTA TODAS EQUIPES, LISTA AS EQUIPES PARA EDITAR
    function list_team($id = NULL, $page = NULL)
    {
        $this->db->select('x1.*,x2.nome_funcionario,x3.nome_tipo_equipe');
        $this->db->from("equipes x1");
        $this->db->join('funcionarios x2', 'x1.inspetor_equipe = x2.id_funcionario');
        $this->db->join('tipo_equipes x3', 'x1.tipo_equipe = x3.id_tipo_equipe');
        if (!empty($id)):
            $this->db->where('x1.id_equipe', $id);
        endif;
        $this->db->limit(10, $page);
        $this->db->order_by('x1.nome_equipe', "ASC");
        return $this->db->get()->result_array();
    }

    function list_inspector_plumber($where)
    {
        $this->db->select('id_funcionario,nome_funcionario');
        $this->db->from("funcionarios");
        $this->db->where('tipo_funcionario', $where);
        return $this->db->get()->result_array();
    }

    function list_employee_manager($idInspetor)
    {
        $this->db->select('id_funcionario as id, nome_funcionario as name');
        $this->db->from("funcionarios");
        $this->db->where('id_funcionario !=', $idInspetor);
        return $this->db->get()->result_array();
    }

    function list_plumber_manager($id)
    {
        $this->db->select('nome_funcionario,x1.*');
        $this->db->from("equipe_funcionarios x1");
        $this->db->join('funcionarios x2', 'x1.id_funcionario = x2.id_funcionario');
        $this->db->where('x1.id_equipe', $id);
        return $this->db->get()->result_array();
    }

    function list_type_team()
    {
        $this->db->select('*');
        $this->db->from("tipo_equipes");
        return $this->db->get()->result_array();
    }

    function list_team_qtd()
    {
        $this->db->select('*');
        $this->db->from("equipes");
        return $this->db->get()->num_rows();
    }

    function check_inspector_team($idFuncionario)
    {
        $this->db->select('*');
        $this->db->from("equipes");
        $this->db->where("inspetor_equipe", $idFuncionario);
        return $this->db->get()->num_rows();
    }

    #VERIFICA SE O E-MAIL NOVO JÁ CONSTA NO SISTEMA
    function check_email($id = NULL, $email = NULL)
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
    function list_search($nome = NULL, $tipoEquipe = NULL, $status = NULL)
    {
        $this->db->select('x1.*,x2.nome_funcionario, x3.nome_tipo_equipe');
        $this->db->from("equipes x1");
        $this->db->join("funcionarios x2", 'x1.inspetor_equipe = x2.id_funcionario', 'left');
        $this->db->join("tipo_equipes x3", 'x1.tipo_equipe = x3.id_tipo_equipe', 'left');
        if (!empty($nome)):
            $this->db->like('x1.nome_equipe', $nome);
        endif;
        if (!empty($tipoEquipe)):
            $this->db->like('x1.tipo_equipe', $tipoEquipe);
        endif;
        if (!empty($status)):
            $this->db->where('x1.status_equipe', $status);
        endif;
        $this->db->order_by('x1.nome_equipe', "ASC");
        return $this->db->get()->result_array();
    }

    function delete($id, $data)
    {
        $this->db->where('id_equipe', $id);
        return $this->db->update('equipes', $data);
    }

    function delete_employee($id)
    {
        $this->db->where('id_funcionario', $id);
        return $this->db->delete('equipe_funcionarios');
    }

    function update($id, $data)
    {
        $this->db->where('id_equipe', $id);
        return $this->db->update('equipes', $data);
    }

    function check_employee_team($idFuncionario)
    {
        $this->db->select('*');
        $this->db->from(" equipe_funcionarios ");
        $this->db->where("id_funcionario", $idFuncionario);
        return $this->db->get()->result_array();
    }

    function list_plumber_team($idEquipe)
    {
        $this->db->select('x2.nome_funcionario');
        $this->db->from(" equipe_funcionarios x1 ");
        $this->db->join("funcionarios x2", 'x1.id_funcionario = x2.id_funcionario');
        $this->db->where("x1.id_equipe", $idEquipe);
        return $this->db->get()->result_array();
    }
}

