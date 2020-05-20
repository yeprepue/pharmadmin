<?php

class Cfarmacia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mfarmacia');
    }
    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vfarmacia');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }
    public function actualizarFarmacia()
    {
        $id = $this->input->post('id');
        $farmacia = $this->input->post('farmacia');
        $res = $this->mfarmacia->actualizarFarmacia($id, $farmacia);
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
    public function cambiarEstadofarmacia()
    {
        $id = $this->input->post('id');
        $res = $this->mfarmacia->cambiarEstadofarmacia($id);
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
    public function registrarFarmacia()
    {
        $farmacia = $this->input->post('farmacia');
        $descripcion = $this->input->post('descripcion');

        // var_dump($farmacia."-".$descripcion);
        // exit;


        $res = $this->mfarmacia->registrarfarmacia($farmacia, $descripcion);
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
    public function consultarFarmacias()
    {
        $res = $this->mfarmacia->consultarFarmacias();
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
