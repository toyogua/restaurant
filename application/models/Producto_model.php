<?php

class Producto_model extends CI_Model{


    public  function getListarTodos()
    {

        $query = $this->db->get('producto');

        return $query->result();
    }


    public function get_productos_info( $porpagina, $desde, $id )
    {
        $this->db->select('
           
           producto.idProducto,
           producto.producto,
           producto.descripcionProducto,
           producto.costoProducto,
           producto.precioProducto,
           producto.cantProducto,
           producto.idSubCategoria,
           producto.imagen as imghx,
           producto.servicio,
        
           categoria.idCategoria,
           categoria.categoria,
           
           subcategorias.idSubcategoria,
           subcategorias.nombre,
           subcategorias.idCategoria
            
            
            ');
        $this->db->from('producto');
        $this->db->join('subcategorias', 'subcategorias.idSubcategoria = producto.idSubCategoria');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
        if ( $id != null )
        {
            $this->db->where('idProducto', $id );
        }
        //$this->db->limit($porpagina, $desde);
        $this->db->order_by('producto','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public  function obtenerPorNombre( $nombre )
    {
        $this->db->like('producto', $nombre);
        $get_data = $this->db->get('producto', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }


    //devuelve todos los productos que esten relacionados a una categoria
    public function get_productos_subcategoria($idSubcategoria, $porpagina, $desde)
    {
       $this->db->reset_query();
        $this->db->limit($porpagina, $desde);
        $this->db->from('producto');
        $this->db->where('idSubcategoria',$idSubcategoria);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

//        return json_encode( $query->result() );
        return $query->result();
    }

    public function countProductosCategoria( $idsubcategoria)
    {
        $this->db->reset_query();

        $this->db->from('producto');
        $this->db->where('idSubCategoria', $idsubcategoria);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->num_rows();
    }

    public function get_producto_info($idProducto){

        $this->db->select('
           
           producto.idProducto,
           producto.producto,
           producto.descripcionProducto,
           producto.costoProducto,
           producto.precioProducto,
           producto.cantProducto,
           producto.idSubCategoria,
           producto.imagen as imghx,
        
           categoria.idCategoria,
           categoria.categoria,
           categoria.descripcionCategoria,
           
           subcategorias.idSubcategoria,
           subcategorias.nombre,
           subcategorias.idCategoria
       
            
            ');
        $this->db->from('producto');
        $this->db->join('subcategorias', 'subcategorias.idSubcategoria = producto.idSubCategoria');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
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
           ingrediente.ingrediente,
           ingrediente.medida
       
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