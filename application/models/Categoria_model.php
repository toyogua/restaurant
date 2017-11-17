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
}