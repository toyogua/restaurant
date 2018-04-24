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

    //devuelve la informacion de todas las mesas que se encuentren ocupadas
    public function getMesa($idMesa){

        $this->db->where('idMesa', $idMesa);
        $this->db->where('ocupada', 0);
        $get_data = $this->db->get('mesa');

        if ($get_data->num_rows() > 0){
            return true ;
        }
    }

    public function obtenerMesa( $id )
    {
        $this->db->where('idMesa', $id);
        $query = $this->db->get('mesa');

        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    //devuelven la informacion de todas las mesas registradas
    public function get_mesas_info()
    {
        $this->db->from('mesa');
        $this->db->where('estado', 1);
        $this->db->order_by('noMesa','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function mesasdesocupadas()
    {
        $this->db->from('mesa');
        $this->db->where('ocupada', 0);
        $this->db->where('estado', 1);
        $this->db->order_by('noMesa','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function crearMesa( $data )
    {
        $this->db->insert('mesa', $data );

        return TRUE;
    }

    public function actualizarMesa( $data, $id)
    {
        $this->db->where('idMesa', $id);
        $this->db->update('mesa', $data);

        return TRUE;
    }

    public function eliminarMesa( $data, $id)
    {
        $this->db->where('idMesa', $id);
        $this->db->update('mesa', $data);

        return TRUE;
    }
}