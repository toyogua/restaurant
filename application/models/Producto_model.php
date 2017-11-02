<?php

class Producto_model extends CI_Model{


    public function get_productos_info()
    {
        $this->db->from('producto');
        $this->db->order_by('producto','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    //devuelve todos los productos que esten relacionados a una categoria
    public function get_productos_categoria($idCategoria)
    {
        $this->db->from('producto');
        $this->db->where('idCategoria',$idCategoria);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

//        return json_encode( $query->result() );
        return $query->result();
    }

}