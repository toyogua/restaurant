<?php

class DetalleProducto_model extends CI_Model{

    //devuelve todos los productos que esten relacionados a una categoria
    public function get_ingredientes_producto($idProducto)
    {
        $this->db->from('detalleproducto');
        $this->db->join('producto', 'producto.idProducto = detalleproducto.idProducto');
        $this->db->join('ingrediente', 'ingrediente.idIngrediente = detalleproducto.idIngrediente');
        $this->db->where('detalleproducto.idProducto',$idProducto);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }else {
            return $query->result();
        }

    }

}