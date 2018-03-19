<?php

class Orden_model extends CI_Model{


    public function insertarOrden($listaOrden, $listaProducto)
    {

        $this->db->trans_begin();

        $this->db->set(
            array(
                'idMesa'         => $listaOrden->idMesa,
                'totalOrden'     => $listaOrden->totalOrden,
                'idEmpleado'     => $listaOrden->idEmpleado,
                'estadoOrden'    => $listaOrden->estadoOrden,
                'fechaOrden'     => $listaOrden->fechaOrden,
                'horaOrden'      => $listaOrden->horaOrden
            )
        )
        ->insert("orden");//inserta la orden

        //recuperamos el id insertado
        $idOrden = $this->db->insert_id();

        $this->db->set(
            array(
                "estadoMesa"     => 1
            )
        )
            ->where("idMesa", $listaOrden->idMesa)
            ->update("mesa");//edita el estado de la mesa

        //deberia insertar los producto
        foreach($listaProducto as $producto){
            $data[]=array(
                'idOrden'           => $idOrden,
                'idProducto'        => $producto->idProducto,
                'cantDetalleOrden'  => $producto->cantDetalleOrden,
                'notaDetalleOrden'  => $producto->notaDetalleOrden
            );

            //obtenemos todos los ingredientes asociados al producto que viene
            $res = $this->descuentaStockIngrediente($producto->idProducto);

            foreach ( $res as $item){
               //obtenemos la cantidad en existencia de ingredientes que tenemos
                $totaladescontar = $producto->cantDetalleOrden * $item->cantidad;

                $quedan = $item->stockingrediente - $totaladescontar;

                $data2 = array(
                    'cantIngrediente'               => $quedan,

                );
                //actualizamos el nuevo stock de los ingredientes
                $this->actualizaStockIngrediente($item->idIngrediente, $data2);


            }

        }
        $this->db->insert_batch('detalleorden', $data);


        if($this->db->trans_status() === TRUE)
        {
            $result = [
                "status"        =>      "success",
                "message"       =>      ""
            ];
            $this->db->trans_commit();
        }
        else
        {
            $result = [
                "status"        =>      "error",
            ];
//            print_r($result); die();
            $this->db->trans_rollback();
            return $result;
        }
        return $result;

    }

    public function descuentaStockIngrediente($idproducto)
    {
        $this->db->select('
           
           detalleproducto.idProducto,
           detalleproducto.cantIngrediente as cantidad,
           ingrediente.idIngrediente,
           ingrediente.cantIngrediente as stockingrediente, 
       
            ');
        $this->db->from('detalleproducto');
        $this->db->join('ingrediente', 'ingrediente.idIngrediente = detalleproducto.idIngrediente');
        $this->db->where('idProducto', $idproducto);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public function actualizaStockIngrediente($idingrediente, $data)
    {
        $this->db->where('idIngrediente', $idingrediente);
        $this->db->update('ingrediente', $data);

        return TRUE;
    }

    public function ordenes_categoria($fecha, $idCategoria){
        $this->db->from('orden');
        $this->db->join('mesa', 'mesa.idMesa = orden.idMesa');
        $this->db->join('detalleorden', 'detalleorden.idOrden = orden.idOrden');
        $this->db->join('producto', 'producto.idProducto = detalleorden.idProducto');
        $this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
        $this->db->where('orden.fechaOrden', $fecha);
        $this->db->where('orden.estadoOrden', 0);
        $this->db->where('detalleorden.estadoDetalleOrden', 0);
        $this->db->where('producto.idCategoria', $idCategoria);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }
    public function ordenes_info($fecha, $idCategoria){
        $this->db->from('orden');
        $this->db->join('mesa', 'mesa.idMesa = orden.idMesa');
        $this->db->join('detalleorden', 'detalleorden.idOrden = orden.idOrden');
        $this->db->join('producto', 'producto.idProducto = detalleorden.idProducto');
        $this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
        $this->db->where('orden.fechaOrden', $fecha);
        $this->db->where('orden.estadoOrden', 0);
        $this->db->where('detalleorden.estadoDetalleOrden', 0);
        $this->db->where('producto.idCategoria', $idCategoria);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }
}