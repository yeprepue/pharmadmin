<?php

class Mmodulo extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function consultarModulos()
    {
        $this->db->select('m.id as idmodulo, m.modulo, m.enlace as menlace, m.icono as micono, m.estado as mestado, m.orden as morden, sm.id as idsubmodulo, sm.submodulo, sm.modulos_id, sm.enlace as smenlace, sm.icono as smicono, sm.estado as smestado, sm.orden as smorden');
        $this->db->from('modulos m');
        $this->db->join('submodulos sm', 'sm.modulos_id=m.id', 'left');
        $this->db->order_by('m.orden,sm.orden', 'asc');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function consultarModulosxRol($permisos)
    {
        $this->db->select('m.id as idmodulo, m.modulo, m.enlace as menlace, m.icono as micono, m.estado as mestado, m.orden as morden, sm.id as idsubmodulo, sm.submodulo, sm.modulos_id, sm.enlace as smenlace, sm.icono as smicono, sm.estado as smestado, sm.orden as smorden, p.id');
        $this->db->from('modulos m');
        $this->db->join('submodulos sm', 'sm.modulos_id=m.id', 'left');
        $this->db->join('permisos p', 'm.id=p.modulos_id');
        $this->db->where_in('p.id', $permisos);
        $this->db->where_in('m.estado', 1);
        $this->db->order_by('m.orden,sm.orden', 'asc');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function cargarModulos()
    {
        $this->db->select('*');
        $this->db->from('modulos');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function cambiarEstadoModulo($id)
    {
        $this->db->select('estado');
        $this->db->from('modulos');
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
        $this->db->update('modulos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function registrarModulo($modulo, $enlace, $icono, $orden)
    {
        //Creamos un arreglo [campo de la base de datos y su respectivo valor]
        $datos = array(
            'modulo' => $modulo,
            'enlace' => $enlace,
            'icono' => $icono,
            'orden' => $orden
        );
        $this->db->insert('modulos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }

    public function actualizarModulo($id, $modulo, $enlace, $icono, $orden)
    {
        $datos = array(
            'modulo' => $modulo,
            'enlace' => $enlace,
            'icono' => $icono,
            'orden' => $orden
        );
        $this->db->select('modulo');
        $this->db->from('modulos');
        $this->db->where('id', $id);
        $this->db->where('modulo', $modulo);
        $this->db->where('enlace', $enlace);
        $this->db->where('icono', $icono);
        $this->db->where('orden', $orden);
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            return true;
        }
        $this->db->where('id', $id);
        $this->db->update('modulos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
