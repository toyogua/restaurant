<?php

class Mesa_model extends CI_Model{


    //devuelbe 3 mesas que contengan el no de mesa que esta ingresando en el buscador ajax
    public function buscarMesa($noMesa){

        $this->db->like('noMesa', $noMesa);
        $get_data = $this->db->get('mesa', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }

    //debuelve la informacion de todas las mesas que se encuentren ocupadas
    public function getMesa($idMesa){

        $this->db->where('idMesa', $idMesa);
        $this->db->where('estadoMesa', 1);
        $get_data = $this->db->get('mesa');

        if ($get_data->num_rows() > 0){
            return true ;
        }
    }

    //devuelven la informacion de todas las mesas registradas
    public function get_mesas_info()
    {
        $this->db->from('mesa');
        $this->db->order_by('noMesa','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }
}