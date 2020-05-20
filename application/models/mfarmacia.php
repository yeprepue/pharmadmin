<?php

class Mfarmacia extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }



    public function consultarFarmacias()
    {
        $this->db->select('*');
        $this->db->from('farmacias');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }
    
    public function registrarFarmacia($farmacia)
    {
        //Creamos un arreglo [campo de la base de datos y su respectivo valor]
        $datos = array(
            'farmacia' => $farmacia,
            
        );
        $this->db->insert('farmacias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }
    public function actualizarFarmacia($id, $farmacia)
    {
        $datos = array(
            'farmacia' => $farmacia
        );
        $this->db->select('farmacia');
        $this->db->from('farmacias');
        $this->db->where('id', $id);
        $this->db->where('farmacia', $farmacia);
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            return true;
        }
        $this->db->where('id', $id);
        $this->db->update('farmacias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiarEstadoFarmacia($id)
    {
        $this->db->select('estado');
        $this->db->from('farmacias');
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
        $this->db->update('farmacias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

   
}
