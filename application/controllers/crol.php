<?php

class Crol extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mrol');
        // $this->load->library('encrypt');
    }

    public function index()
    {
        $this->load->view('vrol');
    }

    public function cGuardar()
    {
        $parametros['rol'] = $this->input->post('rol');
        //Encriptar
        // $parametros['rol'] = $this->encrypt->sha1($this->input->post('rol'));
        // $idRol = $this->mrol->mGuardar($parametros);

        // if ($idRol > 0) {
        //Poner la otra función
        // }
    }
}
