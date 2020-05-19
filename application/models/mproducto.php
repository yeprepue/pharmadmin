<?php

class Mproducto extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function registrarProducto($producto, $idcategoria)
    {
        $datos = array(
            'producto' => $producto,
            'categorias_id' => $idcategoria
        );
        $this->db->insert('productos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }
    public function actualizarProducto($id, $producto, $idcategoria)
    {
        $datos = array(
            'producto' => $producto,
            'categorias_id' => $idcategoria
        );
        $this->db->select('producto');
        $this->db->from('productos');
        $this->db->where('id', $id);
        $this->db->where('producto', $producto);
        $this->db->where('categorias_id', $idcategoria);
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            return true;
        }
        $this->db->where('id', $id);
        $this->db->update('productos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiarEstadoProducto($id)
    {
        $this->db->select('estado');
        $this->db->from('productos');
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
        $this->db->update('productos', $datos);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarProductos()
    {
        $this->db->select('p.id as idproducto, p.producto, c.id as idcategoria, c.categoria, p.estado');
        $this->db->from('productos p');
        $this->db->join('categorias c', 'p.categorias_id=c.id');

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function cargarCategorias()
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
