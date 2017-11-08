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
                'estadoOrden'    => $listaOrden->estadoOrden
            )
        )
        ->insert("orden");//inserta la orden

        //recuperamos el id insertado
        $idOrden = $this->db->insert_id();

        //deberia insertar los producto
        foreach($listaProducto as $producto){
            $data[]=array(
                'idOrden'       => $idOrden,
                'idProducto'    => $producto->idProducto
            );
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
                "message"       =>      $errors
            ];
//            print_r($result); die();
            $this->db->trans_rollback();
            return $result;
        }
        return $result;

    }
}