<?php

class Mcategoria extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function registrarCategoria($categoria, $descripcion)
    {
        //Creamos un arreglo [campo de la base de datos y su respectivo valor]
        $datos = array(
            'categoria' => $categoria,
            'descripcion' =>$descripcion
        );
        $this->db->insert('categorias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }
    
    public function actualizarCategoria($id, $categoria)
    {
        $datos = array(
            'categoria' => $categoria
        );
        $this->db->select('categoria');
        $this->db->from('categorias');
        $this->db->where('id', $id);
        $this->db->where('categoria', $categoria);
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            return true;
        }
        $this->db->where('id', $id);
        $this->db->update('categorias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiarEstadoCategoria($id)
    {
        $this->db->select('estado');
        $this->db->from('categorias');
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
        $this->db->update('categorias', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarCategorias()
    {
        $this->db->select('*');
        $this->db->from('categorias');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }
}
