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

    #VERIFICA NOTA DE REMESSA CADASTRADA
    function check_nota_remessa($notaRemessa)
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        $this->db->where("nota_remessa_entrada_est",$notaRemessa);
        return $this->db->get()->num_rows();
    }


    #QUANTIDADE DE ENTRADAS DE MATERIAS
    function list_material_qtd()
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        return $this->db->get()->num_rows();
    }


    #LISTA TODAS ENTRADAS DE MATERIAS
    function list_material($id = NULL, $page = NULL)
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        if (!empty($id)):
            $this->db->where('id_entrada_est', $id);
        endif;
        $this->db->limit(10, $page);
        $this->db->order_by('data_entrada_est', "ASC");
        return $this->db->get()->result_array();
    }

    function list_type_material()
    {
        $this->db->select('*');
        $this->db->from("tipo_material");
        return $this->db->get()->result_array();
    }

    function list_material_input($idEntradaMaterial)
    {
        $this->db->select('x1.*, x2.nome_tipo_material');
        $this->db->from("estoque_caixa x1");
        $this->db->join("tipo_material x2", "x2.id_tipo_material = x1.id_mat_estoque_caixa");
        $this->db->where('x1.id_entrada_estoque_caixa   ', $idEntradaMaterial);
        return $this->db->get()->result_array();
    }

    function list_search($atendimentoRequisicao = NULL, $notaRemessa = NULL, $status = NULL)
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        if (!empty($atendimentoRequisicao)):
            $this->db->like('atend_requisicao_entrada_est', $atendimentoRequisicao);
        endif;
        if (!empty($notaRemessa)):
            $this->db->like('nota_remessa_entrada_est', $notaRemessa);
        endif;
        if (!empty($status)):
            $this->db->where('status_entrada_est', $status);
        endif;
        $this->db->order_by('data_entrada_est', "DESC");
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

    function delete_caixa_hmy($id)
    {
        $this->db->where('id_estoque_caixa', $id);
        return $this->db->delete('estoque_caixa');
    }

    function check_hmy_table($inicioCaixaHM, $fimCaixaHM)
    {
        $this->db->select('*');
        $this->db->from("estoque_itens_caixa");
        $this->db->where('item_estoque_itens_caixa', $inicioCaixaHM);
        $this->db->or_where('item_estoque_itens_caixa', $fimCaixaHM);
        return $this->db->get()->num_rows();
    }

    function view_caixa_hmy($idCaixaHMY)
    {
        $this->db->select('item_estoque_itens_caixa');
        $this->db->from("estoque_itens_caixa");
        $this->db->where("id_caixa_estoque_itens_caixa",$idCaixaHMY);
        return $this->db->get()->result_array();
    }
}

