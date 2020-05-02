<?php

class Crol extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mrol');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vrol');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function actualizarRol()
    {
        $id = $this->input->post('id');
        $rol = $this->input->post('rol');

        $res = $this->mrol->actualizarRol($id, $rol);

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

    public function cambiarEstadoRol()
    {
        $id = $this->input->post('id');

        $res = $this->mrol->cambiarEstadoRol($id);

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

    public function registrarRol()
    {
        $rol = $this->input->post('rol');
        $res = $this->mrol->registrarRol($rol);
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

    public function consultarRoles()
    {
        $res = $this->mrol->consultarRoles();
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
