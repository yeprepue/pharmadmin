<?php

class Ccategoria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcategoria');
    }
    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vcategoria');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }
    public function actualizarCategoria()
    {
        $id = $this->input->post('id');
        $categoria = $this->input->post('categoria');
        $res = $this->mcategoria->actualizarCategoria($id, $categoria);
        if ($res) {
            echo json_encode(array(
                "status" => 200,
                "msj" => "Actualizado correctamente"
            ));
        } else {
            echo json_encode(array(
                "status" => 404
            ));
        }
    }
    public function cambiarEstadocategoria()
    {
        $id = $this->input->post('id');
        $res = $this->mcategoria->cambiarEstadocategoria($id);
        if ($res) {
            echo json_encode(array(
                "status" => 200,
                "msj" => "Actualizado correctamente"
            ));
        } else {
            echo json_encode(array(
                "status" => 404
            ));
        }
    }
    public function registrarCategoria()
    {
        $categoria = $this->input->post('categoria');
        $descripcion = $this->input->post('descripcion');

        // var_dump($categoria."-".$descripcion);
        // exit;


        $res = $this->mcategoria->registrarcategoria($categoria, $descripcion);
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
    public function consultarCategorias()
    {
        $res = $this->mcategoria->consultarCategorias();
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
