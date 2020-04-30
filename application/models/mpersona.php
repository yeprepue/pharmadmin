<?php

class Mpersona extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function registrarUsuario($parametros)
    {
        $datos = array(
            'nombres' => $parametros['nombres'],
            'apellidos' => $parametros['apellidos'],
            'documento' => $parametros['documento'],
            'tipodocumentos_id' => 1,
            'fechanacimiento' => $parametros['fechanacimiento'],
            'usuario' => $parametros['usuario'],
            'clave' => $parametros['clave'],
            'roles_id' => 2
        );
        $this->db->insert('personas', $datos);
        return $this->db->insert_id();
    }

    public function guardarDatosContacto($parametros)
    {
        $datos = array(
            'direccion' => $parametros['direccion'],
            'correo' => $parametros['correo'],
            'telefono' => $parametros['telefono'],
            'personas_id' => $parametros['personas_id'],
        );
        $this->db->insert('datoscontacto', $datos);
    }

    public function iniciarSesion($usuario, $clave)
    {
        $this->db->select('id, usuario, nombres, apellidos');
        $this->db->from('personas');
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', $clave);

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $fila = $res->row();
            $this->crearSesion($fila);
            return 1;
        } else {
            return 0;
        }
        return $res->result();
    }

    function crearSesion($fila)
    {
        $usuarioSession = array(
            'sIdusuario' => $fila->id,
            'sUsuario' => $fila->usuario,
            'sNombre' => $fila->nombres . ' ' . $fila->apellidos
        );
        $this->session->set_userdata($usuarioSession);
    }
}
