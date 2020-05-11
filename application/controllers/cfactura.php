<?php

class cfactura extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mfactura');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vfactura');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function buscarProducto()
    {
        $producto = $this->input->post('ventaProducto');

        $res = $this->mfactura->buscarProducto($producto);
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

    public function facturar()
    {
        $data = $this->input->post('data');
        $res = $this->mfactura->facturar($data);

        if ($res > 0) {
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
