<?php

class Mreporte extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function consultarFacturas()
    {
        $this->db->select('*');
        $this->db->from('facturas');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function consultarPedidos()
    {
        $this->db->select('*');
        $this->db->from('pedidos');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }
    
}
