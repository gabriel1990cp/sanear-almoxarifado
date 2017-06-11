<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Log_model extends CI_Model
{
    #REGISTRAR LOG
    function register($data)
    {
        return $this->db->insert('log', $data);
    }
}

