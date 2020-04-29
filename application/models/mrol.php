<?php

class Mrol extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function mGuardar($parametros)
    {
        $datos = array(
            'rol' => $parametros['rol']
        );
        $this->db->insert('roles',$datos);
        // return $this->db->insert_id();
    }
}
