<?php

class Ingrediente_model extends CI_Model{


    public function get_ingredientes_info(){
        $this->db->from('ingrediente');
        $this->db->order_by('ingrediente', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }

    public function get_ingrediente_info($idIngrediente){
        $this->db->from('ingrediente');
        $this->db->where('idIngrediente', $idIngrediente);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return false ;
        }
        else{
            return $query->result();
        }

    }

    public function insertIngredientes($data){
        $insert_query = $this->db->insert('ingrediente', $data);
        return $insert_query;
    }

    public function delete_ingrediente($idIngrediente){
        $this->db->where('idIngrediente', $idIngrediente);
        $this->db->delete('ingrediente');
        return TRUE;

    }

    public function edit_ingrediente($idIngrediente, $data)
    {
        $this->db->where('idIngrediente', $idIngrediente);
        $this->db->update('ingrediente', $data);
        return TRUE;
    }
}