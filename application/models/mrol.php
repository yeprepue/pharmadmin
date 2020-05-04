<?php

class Mrol extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function registrarRol($rol)
    {
        $datos = array(
            'rol' => $rol
        );
        $this->db->insert('roles', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }
    public function actualizarRol($id, $rol)
    {
        $datos = array(
            'rol' => $rol
        );
        $this->db->select('rol');
        $this->db->from('roles');
        $this->db->where('id', $id);
        $this->db->where('rol', $rol);
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            return true;
        }
        $this->db->where('id', $id);
        $this->db->update('roles', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiarEstadoRol($id)
    {
        $this->db->select('estado');
        $this->db->from('roles');
        $this->db->where('id', $id);
        $res = $this->db->get();
        foreach ($res->result() as $row) {
            $fila = $row->estado;
        }

        if ($fila == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }

        $datos = array(
            'estado' => $estado
        );

        $this->db->where('id', $id);
        $this->db->update('roles', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarRoles()
    {
        $this->db->select('*');
        $this->db->from('roles');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }
}
