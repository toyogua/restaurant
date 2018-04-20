<?php

class DetalleOrden_model extends CI_Model{


    public function update($idDetalleOrden){

        $this->db->set('estadoDetalleOrden', 1);
        $this->db->where('idDetalleOrden', $idDetalleOrden);
        $this->db->update('detalleorden');
        return true;
    }
}