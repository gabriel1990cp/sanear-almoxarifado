<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Estoque_model extends CI_Model
{
    #CADASTRAR ESTOQUE ENTRADA
    function register($data)
    {
        $this->db->insert('estoque_entrada', $data);
        return $this->db->insert_id();
    }

    function register_material($data)
    {
        $this->db->insert('estoque_caixa',$data);
        return $this->db->insert_id();
    }

    function register_material_item($data)
    {
        $this->db->insert('estoque_itens_caixa',$data);
        return $this->db->insert_id();
    }


    #LISTA TODOS FUNCIONARIOS, LISTA O FUNCIONARIO PARA EDITAR
    function list_employee($id = NULL, $page = NULL)
    {
        $this->db->select('x1.*,x2.nome_carro,x3.nome_cargo');
        $this->db->from("funcionarios x1");
        $this->db->join("carros x2", 'x1.carro_funcionario = x2.id_carro', 'left');
        $this->db->join("cargos x3", 'x1.cargo_funcionario = x3.id_cargo', 'left');
        if (!empty($id)):
            $this->db->where('x1.id_funcionario', $id);
        endif;
        $this->db->limit(10, $page);
        $this->db->order_by('x1.status_funcionario', "ASC");
        $this->db->order_by('x1.nome_funcionario', "ASC");
        return $this->db->get()->result_array();
    }

    function list_type_material()
    {
        $this->db->select('*');
        $this->db->from("tipo_material");
        return $this->db->get()->result_array();
    }

    function list_material($idEntradaMaterial)
    {
        $this->db->select('x1.*, x2.nome_tipo_material');
        $this->db->from("estoque_caixa x1");
        $this->db->join("tipo_material x2", "x2.id_tipo_material = x1.id_mat_estoque_caixa");
        $this->db->where('x1.id_entrada_estoque_caixa   ', $idEntradaMaterial);
        return $this->db->get()->result_array();
    }

    function list_car()
    {
        $this->db->select('*');
        $this->db->from("carros");
        $this->db->order_by('nome_carro', 'ASC');
        return $this->db->get()->result_array();
    }

    function list_office()
    {
        $this->db->select('*');
        $this->db->from("cargos");
        $this->db->order_by('nome_cargo', 'ASC');
        return $this->db->get()->result_array();
    }

    function list_employee_qtd()
    {
        $this->db->select('*');
        $this->db->from("funcionarios");
        return $this->db->get()->num_rows();
    }


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


    function list_user_password($id = NULL, $senhaAtual = NULL)
    {
        $this->db->select('*');
        $this->db->from("usuarios");
        $this->db->where('senha_usuario', $senhaAtual);
        $this->db->where('id_usuario', $id);
        return $this->db->get()->num_rows();
    }


    function list_search($nome = NULL, $cpf = NULL, $status = NULL)
    {
        $this->db->select('x1.*,x2.nome_carro,x3.nome_cargo');
        $this->db->from("funcionarios x1");
        $this->db->join("carros x2", 'x1.carro_funcionario = x2.id_carro', 'left');
        $this->db->join("cargos x3", 'x1.cargo_funcionario = x3.id_cargo', 'left');
        if (!empty($nome)):
            $this->db->like('x1.nome_funcionario', $nome);
        endif;
        if (!empty($cpf)):
            $this->db->like('x1.cpf_funcionario', $cpf);
        endif;
        if (!empty($status)):
            $this->db->where('x1.status_funcionario', $status);
        endif;
        $this->db->order_by('x1.nome_funcionario', "ASC");
        return $this->db->get()->result_array();
    }

    function delete($id, $data)
    {
        $this->db->where('id_funcionario', $id);
        return $this->db->update('funcionarios', $data);
    }

    function update($id, $data)
    {
        $this->db->where('id_funcionario', $id);
        return $this->db->update('funcionarios', $data);
    }
}

