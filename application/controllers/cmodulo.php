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
        $res = $this->mmodulo->consultarModulos();
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
