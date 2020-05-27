<?php

class Cpermiso extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->model('mproducto');
    }

    public function index()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('administracion/vpermiso');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }
}
