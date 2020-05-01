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
            return $this->db->insert_id();
        }
        return false;
    }
    public function actualizarRol($id, $rol)
    {
        $datos = array(
            'rol' => $rol
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
