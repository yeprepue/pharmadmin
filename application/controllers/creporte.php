<?php

class Creporte extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mreporte');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('reportes/vreporte');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function reportes()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('reportes/vreporte');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function consultarFacturas()
    {
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');


        if ($fechaInicial == null) {
            $fechaInicial = date("yy-m-d");
            $fecha = date('Y-m-j');
            $fechaFinal = strtotime('-8 day', strtotime($fechaInicial));
            $fechaFinal = date('Y-m-j', $fechaFinal);
        }
        $fechaInicial = strtotime('+1 day', strtotime($fechaInicial));
        $fechaInicial = date('Y-m-j', $fechaInicial);

        $res = $this->mreporte->consultarFacturas($fechaInicial, $fechaFinal);

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

    public function consultarPedidos()
    {
        $res = $this->mreporte->consultarPedidos();
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
