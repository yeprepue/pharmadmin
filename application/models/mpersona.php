<?php

class Mpersona extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function mGuardarPersona($parametros)
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

    public function mGuardarContacto($parametros)
    {
        $datos = array(
            'direccion' => $parametros['direccion'],
            'correo' => $parametros['correo'],
            'telefono' => $parametros['telefono'],
            'personas_id' => $parametros['personas_id'],
        );
        $this->db->insert('datoscontacto', $datos);
        // return $this->db->insert_id();
    }
}
