<?php

class Producto_model extends CI_Model{


    public  function getListarTodos()
    {

        $query = $this->db->get('producto');

        return $query->result();
    }


    public function get_productos_info()
    {
        $this->db->distinct();
        $this->db->select('
           
           producto.idProducto,
           producto.producto,
           producto.descripcionProducto,
           producto.costoProducto,
           producto.precioProducto,
           producto.cantProducto,
           producto.idCategoria,
           producto.imagen as imghx,
        
           categoria.idCategoria,
           categoria.categoria,
           categoria.descripcionCategoria
            
            
            ');
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
    public function get_productos_categoria($idCategoria, $porpagina, $desde)
    {
       $this->db->reset_query();
        $this->db->limit($porpagina, $desde);
        $this->db->from('producto');
        $this->db->where('idCategoria',$idCategoria);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

//        return json_encode( $query->result() );
        return $query->result();
    }

    public function countProductosCategoria($idCategoria)
    {
        $this->db->reset_query();

        $this->db->from('producto');
        $this->db->where('idCategoria',$idCategoria);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

//        return json_encode( $query->result() );
        return $query->num_rows();
    }

    public function get_producto_info($idProducto){

        $this->db->distinct();
        $this->db->select('
           
           producto.idProducto,
           producto.producto,
           producto.descripcionProducto,
           producto.costoProducto,
           producto.precioProducto,
           producto.cantProducto,
           producto.idCategoria,
           producto.imagen as imghx,
        
           categoria.idCategoria,
           categoria.categoria,
           categoria.descripcionCategoria,
       
            
            ');
        $this->db->from('producto');
        $this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
        $this->db->where('idProducto', $idProducto);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }

    public function getIngredientesProducto($idProducto)
    {
        $this->db->distinct();
        $this->db->select('
           
           detalleproducto.idProducto,
           detalleproducto.idIngrediente,
           detalleproducto.cantIngrediente,
        
           ingrediente.idIngrediente,
           ingrediente.ingrediente
       
            ');
        $this->db->from('detalleproducto');
        $this->db->join('ingrediente', 'ingrediente.idIngrediente = detalleproducto.idIngrediente');
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
        $this->db->insert('producto', $data);
        $last_id = $this->db->insert_id();

        return $last_id;
        //return $insert_query;

    }

    public function updateImage($id, $archivo)
    {
        $this->db->where('idProducto', $id);
        $this->db->update('producto', $archivo);

        return TRUE;
    }

    public function delete_producto($idProducto){
        $this->db->where('idProducto', $idProducto);
        $this->db->delete('producto');
        return TRUE;

    }

    public function edit_producto($idProducto, $data)
    {
        $this->db->reset_query();
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);

        return TRUE;
    }

    public function  getIngredienteAjax($ingrediente)
    {
        $this->db->like('ingrediente', $ingrediente);
        $get_data = $this->db->get('ingrediente', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }

    public function insertardetalleproducto($dataingrediente)
    {
        $this->db->insert('detalleproducto', $dataingrediente);
        return TRUE;
    }

    public function deleteIngrediente($idIngrediente, $idProducto){
        $this->db->where('idIngrediente', $idIngrediente);
        $this->db->where('idProducto', $idProducto);
        $this->db->delete('detalleproducto');
        return TRUE;

    }


}