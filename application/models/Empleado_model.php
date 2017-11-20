<?php

class Empleado_model extends CI_Model{


    //devuelve 3 empleados que contenga el nombre que se esta ingresando en el buscador ajax, pantalla de orden
    public function buscarEmpleado($nombreMesero){

        $this->db->like('nombresEmpleado', $nombreMesero);
        $get_data = $this->db->get('empleado', 3);

        if ($get_data->num_rows() < 1){
            return false ;
        }
        return $get_data->result();
    }

    //devuelve la informacion de todos los empleados registrados
    public function get_empleados_info()
    {
        $this->db->from('empleado');
        $this->db->order_by('nombresEmpleado','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }
}