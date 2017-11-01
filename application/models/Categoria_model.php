<?php

class Categoria_model extends CI_Model{


    public function get_categorias_info()
    {
        $this->db->from('categoria');
        $this->db->order_by('categoria','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }
}