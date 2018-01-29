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

    public function get_categorias(){

        // armamos la consulta
        $query = $this->db-> query('SELECT idCategoria, categoria FROM categoria');

        // si hay resultados
        if ($query->num_rows() > 0) {
            // almacenamos en una matriz bidimensional
            foreach($query->result() as $row)
                $categoria[htmlspecialchars($row->idCategoria, ENT_QUOTES)] =
                    htmlspecialchars($row->categoria, ENT_QUOTES);

            $query->free_result();
            return $categoria;
        }
    }

    public function buscarCategoria($categoria){

        $this->db->like('categoria', $categoria);
        $get_data = $this->db->get('categoria', 3);

        if ($get_data->num_rows() < 1){
            return null ;
        }
        return $get_data->result();
    }

    public function getCategoria($categoria){

        $this->db->like('categoria', $categoria);
        $get_data = $this->db->get('categoria', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }

}