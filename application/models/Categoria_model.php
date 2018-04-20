<?php

class Categoria_model extends CI_Model{


    public function get_subcategorias_info()
    {
        $this->db->select('
           
           subcategorias.idSubcategoria,
           subcategorias.nombre,
           subcategorias.idCategoria,
         
           categoria.idCategoria,
           categoria.categoria
           
          ');
        $this->db->from('subcategorias');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
        $this->db->where('subcategorias.estado', 1 );
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public function categorias()
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

    public function insertarSubCategoria($data)
    {
        $this->db->insert('subcategorias', $data);
        return TRUE;
    }

    public function getSubCategoriaInfo( $idsubcategoria ){
        $this->db->select('
           
           subcategorias.idSubcategoria,
           subcategorias.nombre,
           subcategorias.idCategoria,
         
           categoria.categoria
           
          ');
        $this->db->from('subcategorias');
        $this->db->join('categoria', 'categoria.idCategoria = subcategorias.idCategoria');
        $this->db->where('subcategorias.idSubcategoria', $idsubcategoria);
        $this->db->where('subcategorias.estado', 1);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public function udpateSubCategoria($data, $idsubcategoria)
    {
        $this->db->where('idSubcategoria', $idsubcategoria);
        $this->db->update('subcategorias', $data);

        return TRUE;
    }

    public function deleteSubCategoria( $data, $idsubcategoria)
    {
        $this->db->where('idSubcategoria', $idsubcategoria);
        $this->db->update('subcategorias', $data);

        return TRUE;
    }

    public function getSubCategoriaBebida(  ){
        $this->db->from('subcategorias');
        $this->db->where('idCategoria', 2);
        $this->db->where('estado', 1);
        $this->db->order_by('nombre','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function getSubCategoriaComida(  )
    {
        $this->db->from('subcategorias');
        $this->db->where('idCategoria', 1);
        $this->db->where('estado', 1);
        $this->db->order_by('nombre','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }


}