<?php

class Ingrediente_model extends CI_Model{


    public function get_ingredientes_info( $porpagina, $desde, $id ){
        $this->db->from('ingrediente');

        if ($id != null ){
            $this->db->where('idIngrediente', $id);
        }
        $this->db->limit($porpagina, $desde);
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
         $this->db->insert('ingrediente', $data);
        return TRUE;
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

    public function obtenerPorNombre( $nombre, $campo, $tabla )
    {
        $this->db->like($campo, $nombre);
        $get_data = $this->db->get($tabla, 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }


}