<?php
/**
 * Created by PhpStorm.
 * User: ROCKSOFT
 * Date: 10/04/2018
 * Time: 08:34 PM
 */

class Venta_model extends CI_Model
{


    public function obtenerOrdenesApagar()
    {

        $this->db->from('orden');
        $this->db->join('mesa', 'mesa.idMesa = orden.idMesa');
        $this->db->join('detalleorden', 'detalleorden.idOrden = orden.idOrden');
        $this->db->join('producto', 'producto.idProducto = detalleorden.idProducto');
        $this->db->join('subcategorias', 'subcategorias.idSubcategoria = producto.idSubCategoria');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
        //$this->db->where('orden.fechaOrden', $fecha);
        $this->db->where('orden.pagada', 0);
        $this->db->where('detalleorden.estadoDetalleOrden', 1);
        //$this->db->where('categoria.idCategoria', $idCategoria);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }
    }

    public function obtenesMesasOcupadas()
    {
        $this->db->from('mesa');
        $this->db->where('ocupada', 1);
        $this->db->where('estado', 1);
        $this->db->order_by('noMesa','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function obtenerOrden( $idmesa )
    {
        $this->db->from('orden');
        $this->db->join('mesa', 'mesa.idMesa = orden.idMesa');
        $this->db->join('detalleorden', 'detalleorden.idOrden = orden.idOrden');
        $this->db->join('producto', 'producto.idProducto = detalleorden.idProducto');
        $this->db->join('subcategorias', 'subcategorias.idSubcategoria = producto.idSubCategoria');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
        //$this->db->where('orden.fechaOrden', $fecha);
        $this->db->where('orden.estadoOrden', 1);
        //$this->db->where('detalleorden.estadoDetalleOrden', 0);
        $this->db->where('orden.pagada', 0);
        $this->db->where('mesa.idMesa', $idmesa);

        //$this->db->where('categoria.idCategoria', $idCategoria);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }

    public function insertarVenta($data)
    {
        $this->db->insert('ventas', $data);
        $last_id = $this->db->insert_id();

        return $last_id;

    }

    public function insertaDetalleVenta( $data )
    {
        $this->db->insert('detalleventas', $data);
        return TRUE;

    }
}


//End of file locations application/models/Venta_model.php