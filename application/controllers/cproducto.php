<?php

class Cproducto extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mproducto');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('productos/vproducto');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function sppiner()
    {
        return json_encode("ok");
    }

    public function actualizarProducto()
    {
        $id = $this->input->post('id');
        $producto = $this->input->post('producto');
        $idcategoria = $this->input->post('idcategoria');

        $res = $this->mproducto->actualizarProducto($id, $producto, $idcategoria);

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

    public function cambiarEstadoProducto()
    {
        $id = $this->input->post('id');

        $res = $this->mproducto->cambiarEstadoProducto($id);

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

    public function registrarProducto()
    {
        $producto = $this->input->post('producto');
        $idcategoria = $this->input->post('selCategoria');

        $res = $this->mproducto->registrarProducto($producto, $idcategoria);
        if ($res) {
            echo json_encode(array(
                "status" => 200,
                "msj" => "Registrado correctamente"
            ));
        } else {
            echo json_encode(array(
                "status" => 404
            ));
        }
    }

    public function consultarProductos()
    {
        $res = $this->mproducto->consultarProductos();
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

    public function cargarCategorias()
    {
        $res = $this->mproducto->cargarCategorias();
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
