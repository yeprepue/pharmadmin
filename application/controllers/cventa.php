<?php

class Cventa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mventa');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vventa');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function buscarProducto()
    {
        $producto = $this->input->post('ventaProducto');

        $res = $this->mventa->buscarProducto($producto);
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
