<?php

class Cmodulo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mmodulo');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('administracion/vmodulo');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
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

    public function consultarModulosxRol()
    {
        //Eliminamos espacios y comas.
        $permisos = trim($this->session->userdata('sPermisos'), ',');
        //Convertimos el arreglo a enteros
        $permisos = array_map('intval', explode(',', $permisos));

        $res = $this->mmodulo->consultarModulosxRol($permisos);
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

    public function cargarModulos()
    {
        $res = $this->mmodulo->cargarModulos();
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

    public function cambiarEstadoModulo()
    {
        $id = $this->input->post('id');

        $res = $this->mmodulo->cambiarEstadoModulo($id);

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

    public function registrarModulo()
    {
        $modulo = $this->input->post('modulo');
        $menlace = $this->input->post('menlace');
        $micono = $this->input->post('micono');
        $morden = $this->input->post('morden');


        $res = $this->mmodulo->registrarModulo($modulo, $menlace, $micono);
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

    public function actualizarModulo()
    {
        $id = $this->input->post('id');
        $modulo = $this->input->post('modulo');
        $menlace = $this->input->post('menlace');
        $micono = $this->input->post('micono');
        $morden = $this->input->post('morden');

        $res = $this->mmodulo->actualizarModulo($id, $modulo, $menlace, $micono, $morden);

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
}
