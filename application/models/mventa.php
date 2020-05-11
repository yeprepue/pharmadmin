<?php

class Mventa extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function buscarProducto($producto)
    {
        $this->db->select('dp.id, p.producto, m.medida, nt.numero as numerotipo, nm.numero as numeromedida, tp.tipo, mar.marca, dp.codigobarras, dp.precioventa ');
        $this->db->from('detalleproductos dp');
        $this->db->join('productos p', 'dp.productos_id=p.id ');
        $this->db->join('medidas m', 'dp.medidas_id=m.id');
        $this->db->join('numerotipos nt', 'dp.numerotipos_id=nt.id');
        $this->db->join('numeromedidas nm', 'dp.numeromedidas_id=nm.id');
        $this->db->join('tipoproductos tp', 'dp.tipoproductos_id=tp.id');
        $this->db->join('marcas mar', 'dp.marcas_id=mar.id');
        $this->db->like('p.producto', $producto);

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }

    public function facturar($data)
    {
        $datos = json_decode($data);
        $this->db->insert_batch('movimientos', $datos->datos);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }
}
