<?php

class DetalleOrden_model extends CI_Model{


    public function insertarDetalleOrden($data)
    {
        $this->db->insert('detalleorden', $data);
    }
}