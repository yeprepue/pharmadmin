<?php

class Cpersona extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mpersona');
        // $this->load->library('encryption');
    }

    public function index()
    {
        $this->load->view('vpersona');
    }

    public function cGuardarPersona()
    {
        $parametros['nombres'] = $this->input->post('nombres');
        $parametros['apellidos'] = $this->input->post('apellidos');
        $parametros['documento'] = $this->input->post('documento');
        $parametros['fechanacimiento'] = $this->input->post('fechanacimiento');
        $parametros['usuario'] = $this->input->post('usuario');
        $parametros['clave'] = $this->input->post('clave');
        $parametros['direccion'] = $this->input->post('direccion');
        $parametros['correo'] = $this->input->post('correo');
        $parametros['telefono'] = $this->input->post('telefono');

        $idPersona = $this->mpersona->mGuardarPersona($parametros);

        if ($idPersona > 0) {

            $parametros['personas_id'] = $idPersona;
            $this->mpersona->mGuardarContacto($parametros);
        }
    }
}
