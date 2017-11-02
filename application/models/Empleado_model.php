<?php

class Empleado_model extends CI_Model{


    public function buscarEmpleado($nombreMesero){

        $this->db->like('nombresEmpleado', $nombreMesero);
        $get_data = $this->db->get('empleado', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }
}