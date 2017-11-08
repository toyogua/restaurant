<?php

class Mesa_model extends CI_Model{


    public function buscarMesa($noMesa){

        $this->db->like('noMesa', $noMesa);
        $get_data = $this->db->get('mesa', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }

    public function getMesa($idMesa){

        $this->db->where('idMesa', $idMesa);
        $this->db->where('estadoMesa', 1);
        $get_data = $this->db->get('mesa');

        if ($get_data->num_rows() > 0){
            return true ;
        }
    }
}