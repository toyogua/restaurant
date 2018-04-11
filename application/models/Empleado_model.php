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
        $this->db->where('estado', 1);
        $this->db->order_by('nombresEmpleado','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function todosTipos(){
        $this->db->from('tipoempleado');
        $this->db->where('estado', 1);
        $this->db->order_by('tipoEmpleado','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
    }

    public function crearEmpleado( $data )
    {
        $this->db->insert('empleado',$data);
        $ultimo_id = $this->db->insert_id();
        return $ultimo_id;

    }

    public function  empleadoInfo( $idempleado )
    {
        $this->db->select('
           
           empleado.idEmpleado,
           empleado.nombresEmpleado,
           empleado.apellidosEmpleado,
           empleado.telefonoEmpleado,
           empleado.emailEmpleado,
           empleado.idTipoEmpleado,
           
           tipoempleado.idTipoEmpleado,
           tipoempleado.tipoEmpleado,
           
           users.idUser,
           users.username,
           users.idEmpleado
       
            ');
        $this->db->from('empleado');
        $this->db->join('tipoempleado', 'tipoempleado.idTipoEmpleado = empleado.idTipoEmpleado');
        $this->db->join('users', 'users.idEmpleado = empleado.idEmpleado');
        $this->db->where('empleado.idEmpleado', $idempleado);
        $this->db->where('empleado.estado', 1);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public function actualizarEmpleado( $data, $id)
    {
        $this->db->where('idEmpleado', $id);
        $this->db->update('empleado', $data);
    }

    public function eliminarEmpleado( $data, $id )
    {
        $this->db->where('idEmpleado', $id);
        $this->db->update('empleado', $data);

        return TRUE;
    }

    public function crearTipo( $data )
    {
        $this->db->insert('tipoempleado', $data );
        return TRUE;
    }

    public function tipoInfo( $id )
    {
        $this->db->where('idTipoEmpleado', $id);
        $get_data = $this->db->get('tipoempleado');

        if ($get_data->num_rows() < 1){
            return FALSE ;
        }
        return $get_data->result();
    }

    public function actualizarTipo( $id, $data)
    {
        $this->db->where('idTipoEmpleado', $id);
        $this->db->update('tipoempleado', $data);

        return TRUE;
    }

    public function eliminarTipo( $id, $data )
    {
        $this->db->where('idTipoEmpleado', $id);
        $this->db->update('tipoempleado', $data);

        return TRUE;
    }
}