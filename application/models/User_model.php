<?php

class User_model extends CI_Model{


    public function create_user( $data ){

        $this->db->insert('users',$data);

        return TRUE;

    }

    public function edit_user($idUser, $data)
    {
        $this->db->where('id', $idUser);
        $this->db->update('users', $data);
        return TRUE;
    }

    public function delete_user($data, $id){
        $this->db->where('idEmpleado', $id);
        $this->db->update('users', $data );
        return TRUE;
    }


    public function get_last_id()
    {
        /*Obtiene el ultimo id ingresado a la tabla empleado*/
        $last_id = $this->db->insert_id();
        return $last_id;
    }



    public function login_user($username, $password)
    {
        $this->db->select('
           empleado.idEmpleado,
           
           tipoempleado.idTipoEmpleado,
           tipoempleado.tipoEmpleado,
           users.idUser,
           users.username,
           users.password
  
            ');
        $this->db->from('users');
        $this->db->join('empleado', 'empleado.idEmpleado = users.idEmpleado');
        $this->db->join('tipoempleado', 'tipoempleado.idTipoEmpleado = empleado.idTipoEmpleado');

        $this->db->where('users.username', $username);
        $result = $this->db->get();

        $db_password = $result->row()->password;

        if(password_verify($password, $db_password)){

            return $result->row();
        }
        else{
            return FALSE;
        }
    }

    public function get_users(){

        // armamos la consulta
        $query = $this->db-> query('SELECT id, username FROM users');

        // si hay resultados
        if ($query->num_rows() > 0) {
            // almacenamos en una matriz bidimensional
            foreach($query->result() as $row)
                $users[htmlspecialchars($row->id, ENT_QUOTES)] =
                    htmlspecialchars($row->username, ENT_QUOTES);

            $query->free_result();
            return $users;
        }
    }


    public function update_pass($data, $user_id)
    {

        $this->db->where('idEmpleado', $user_id);
        $this->db->update('users', $data);

        return TRUE;

    }

    public function get_users_info()
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
        $this->db->where('empleado.estado', 1);
        $query = $this->db->get();

        if ($query->num_rows() < 1){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    public function get_user_info($id)
    {
        $this->db->from('users');
        $this->db->where('id',$id);

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->row();
    }

}