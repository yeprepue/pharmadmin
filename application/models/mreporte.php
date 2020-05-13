<?php

class Mreporte extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function consultarFacturas($fechaInicial, $fechaFinal)
    {
        $this->db->select('*');
        $this->db->from('facturas');
        $this->db->where('fecha <', $fechaInicial);
        $this->db->where('fecha >', $fechaFinal);

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
