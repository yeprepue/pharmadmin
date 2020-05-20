<?php

class Mmodulo extends CI_Model
{
    function   __construct()
    {
        parent::__construct();
    }

    public function consultarModulos($permisos)
    {
        $this->db->select('m.id as idmodulo, m.modulo, m.enlace as menlace, m.icono as micono, m.estado as mestado, sm.id as idsubmodulo, sm.submodulo, sm.modulos_id, sm.enlace as smenlace, sm.icono as smicono, sm.estado as smestado, p.id');
        $this->db->from('modulos m');
        $this->db->join('submodulos sm', 'sm.modulos_id=m.id', 'left');
        $this->db->join('permisos p', 'm.id=p.modulos_id');
        $this->db->where_in('p.id', $permisos);
        $this->db->order_by('m.orden,sm.orden', 'asc');

        //         SELECT * FROM modulos m 
        // left join submodulos sm on sm.modulos_id=m.id
        // inner join permisos p on m.id=p.modulos_id

        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $result = $res->result();
            return $result;
        } else {
            return false;
        }
    }
}
