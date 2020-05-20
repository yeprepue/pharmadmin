<?php

class Cfarmacias extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mfarmacias');
    }
    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vfarmacias');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }
    public function registrarFarmacias()
    {
        $farmacia = $this->input->post('farmacia');
        
        //var_dump($farmacia);
        //exit;

        $res = $this->mfarmacias->registrarFarmacias($farmacia);
        if ($res) {
            echo json_encode(
                array(
                    "status" => 200,
                    "msj" => "Registrado correctamente"
                )
            );
        } else {
            echo json_encode(array(
                "status" => 404
            ));
        }
    }
}