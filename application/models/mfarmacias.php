<?php

class mfarmacias extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }
    public function registrarFarmacias($farmacia)
    {
        //Creamos un arreglo [campo de la base de datos y su respectivo valor]
        $datos = array(
            'farmacia' => $farmacia,
            
        );
        $this->db->insert('farmacias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    } 
}