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
        $data['mensaje'] = "";
        $this->load->view('personas/vingreso', $data);
    }

    public function registrarUsuario()
    {
        $parametros['nombres'] = $this->input->post('nombres');
        $parametros['apellidos'] = $this->input->post('apellidos');
        $parametros['documento'] = $this->input->post('documento');
        $parametros['fechanacimiento'] = $this->input->post('fechanacimiento');
        $parametros['usuario'] = $this->input->post('usuario');
        $parametros['clave'] = sha1($this->input->post('clave'));
        $parametros['direccion'] = $this->input->post('direccion');
        $parametros['correo'] = $this->input->post('correo');
        $parametros['telefono'] = $this->input->post('telefono');

        $idPersona = $this->mpersona->registrarUsuario($parametros);

        if ($idPersona > 0) {

            $parametros['personas_id'] = $idPersona;
            $this->mpersona->guardarDatosContacto($parametros);
        }
    }

    public function formularioIngreso()
    {
        $data['mensaje'] = "";
        $this->load->view('personas/vingreso', $data);
    }

    public function formularioRegistro()
    {
        $this->load->view('personas/vregistro');
    }

    public function inicio()
    {
        if ($this->session->userdata('sUsuario')) {
            $this->load->view('plantilla/cabecera');
            $this->load->view('plantilla/menu');
            $this->load->view('vinicio');
            $this->load->view('plantilla/pie');
        } else {
            $this->load->view('personas/vingreso');
        }
    }

    public function iniciarSesion()
    {
        $usuario = $this->input->post('usuario');
        $clave = sha1($this->input->post('clave'));

        $res = $this->mpersona->iniciarSesion($usuario, $clave);

        if ($res) {
            $this->crearSesion($res);
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

    public function cerrarSesion()
    {
        $usuarioSession = array(
            'sIdusuario' => false,
            'sUsuario' => false,
            'sNombre' => false,
            'sRol' => false
        );
        $this->session->set_userdata($usuarioSession);
        $this->load->view('personas/vingreso');
    }

    function crearSesion($res)
    {
        $usuarioSession = array(
            'sIdusuario' => $res->id,
            'sUsuario' => $res->usuario,
            'sNombre' => $res->nombres,
            'sRol' => $res->roles_id
        );
        $this->session->set_userdata($usuarioSession);
    }
}
