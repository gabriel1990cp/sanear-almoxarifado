<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Estoque_model extends CI_Model
{
    #CADASTRAR ESTOQUE ENTRADA
    function register($data)
    {
        $this->db->insert('estoque_entrada', $data);
        return $this->db->insert_id();
    }

    function insert_hmy($data)
    {
        $this->db->insert('estoque_hmy_caixa',$data);
        return $this->db->insert_id();
    }

    function insert_hm_avulso($data)
    {
        $this->db->insert('estoque_hm_avulso',$data);
        return $this->db->insert_id();
    }

    function insert_hmy_item($data)
    {
        $this->db->insert('estoque_hmy_caixa_itens',$data);
        return $this->db->insert_id();
    }

    #VERIFICA NOTA DE REMESSA CADASTRADA
    function check_nota_remessa($notaRemessa)
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        $this->db->where("nota_remessa_est_entrada",$notaRemessa);
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
            $this->db->where('id_est_entrada', $id);
        endif;
        $this->db->limit(10, $page);
        $this->db->order_by('data_est_entrada', "ASC");
        return $this->db->get()->result_array();
    }

    function list_type_material()
    {
        $this->db->select('*');
        $this->db->from("tipo_material");
        return $this->db->get()->result_array();
    }

    function name_material($material)
    {
        $this->db->select('nome_tipo_material');
        $this->db->from("tipo_material");
        $this->db->where('id_tipo_material',$material);
        return $this->db->get()->result_array();

    }

    function list_material_input_hmy($idEntradaMaterial)
    {
        $this->db->select('x1.*, x2.nome_tipo_material');
        $this->db->from("estoque_hmy_caixa x1");
        $this->db->join("tipo_material x2", "x2.id_tipo_material = x1.id_mat_est_caixa_hmy");
        $this->db->where('x1.id_entrada_est_caixa_hmy', $idEntradaMaterial);
        return $this->db->get()->result_array();
    }

    function list_material_input_hm($idEntradaMaterial,$material)
    {
        $this->db->select('x1.*, x2.nome_tipo_material');
        $this->db->from("estoque_hm_avulso x1");
        $this->db->join("tipo_material x2", "x2.id_tipo_material = x1.id_mat_est_hm_avulso");
        $this->db->where('x1.id_entrada_est_hm_avulso', $idEntradaMaterial);
        $this->db->where('x1.id_mat_est_hm_avulso', $material);
        return $this->db->get()->result_array();
    }

    function list_search($atendimentoRequisicao = NULL, $notaRemessa = NULL, $status = NULL)
    {
        $this->db->select('*');
        $this->db->from("estoque_entrada");
        if (!empty($atendimentoRequisicao)):
            $this->db->like('atend_requisicao_est_entrada', $atendimentoRequisicao);
        endif;
        if (!empty($notaRemessa)):
            $this->db->like('nota_remessa_est_entrada', $notaRemessa);
        endif;
        if (!empty($status)):
            $this->db->where('status_est_entrada', $status);
        endif;
        $this->db->order_by('data_est_entrada', "DESC");
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
        $this->db->where('id_est_caixa_hmy', $id);
        return $this->db->delete('estoque_hmy_caixa');
    }

    function delete_caixa_hm_avulso($id)
    {
        $this->db->where('id_est_hm_avulso', $id);
        return $this->db->delete('estoque_hm_avulso');
    }

    function count_input_material()
    {

    }

    function check_hmy_table($inicioCaixaHM, $fimCaixaHM)
    {
        $this->db->select('*');
        $this->db->from("estoque_hmy_caixa_itens");
        $this->db->where('item_est_caixa_hmy_itens', $inicioCaixaHM);
        $this->db->or_where('item_est_caixa_hmy_itens', $fimCaixaHM);
        return $this->db->get()->num_rows();
    }

    function check_hm_table($hmAvulso)
    {
        $this->db->select('*');
        $this->db->from("estoque_hm_avulso");
        $this->db->where('numero_est_hm_avulso', $hmAvulso);
        return $this->db->get()->num_rows();
    }

    function view_caixa_hmy($idCaixaHMY)
    {
        $this->db->select('item_est_caixa_hmy_itens');
        $this->db->from("estoque_hmy_caixa_itens");
        $this->db->where("id_caixa_est_caixa_hmy_itens",$idCaixaHMY);
        return $this->db->get()->result_array();
    }
}

