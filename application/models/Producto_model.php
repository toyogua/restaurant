<?php

class Producto_model extends CI_Model{


    public function get_productos_info()
    {
        $this->db->from('producto');
        $this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
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

    public function get_producto_info($idProducto){
        $this->db->from('producto');
        $this->db->where('idProducto', $idProducto);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }

    public function insertProducto($data){
        $insert_query = $this->db->insert('producto', $data);
        return $insert_query;
    }

    public function delete_producto($idProducto){
        $this->db->where('idProducto', $idProducto);
        $this->db->delete('producto');
        return TRUE;

    }

    public function edit_producto($idProducto, $data)
    {
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
        return TRUE;
    }

}