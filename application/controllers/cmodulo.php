<?php

class Cmodulo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mmodulo');
    }

    public function consultarModulos()
    {
        //Eliminamos espacios y comas.
        $permisos = trim($this->session->userdata('sPermisos'), ',');
        //Convertimos el arreglo a enteros
        $permisos = array_map('intval', explode(',', $permisos));

        $res = $this->mmodulo->consultarModulos($permisos);
        if ($res) {
            echo json_encode(array(
                "status" => 200,
                "data" => $res
            ));
        } else {
            echo json_encode(array(
                "status" => 404
            ));
        }
    }
}
