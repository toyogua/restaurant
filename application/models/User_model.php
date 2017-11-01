<?php

class User_model extends CI_Model{


    public function create_user(){

        $options = ['cost'=>12];
        $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT,  $options);

        $data = array(

            'nombres'       => $this->input->post('nombres'),
            'apellidos'     => $this->input->post('apellidos'),
            'email'         => $this->input->post('email'),
            'username'      => $this->input->post('username'),
            'password'      => $encripted_pass
        );

        $insert_data = $this->db->insert('users',$data);

        return $insert_data;

    }

    public function edit_user($idUser, $data)
    {
        $this->db->where('id', $idUser);
        $this->db->update('users', $data);
        return TRUE;
    }

    public function delete_user($idUser){
        $this->db->where('id', $idUser);
        $this->db->delete('users');
        return TRUE;
    }


    public function get_last_id()
    {
        /*Obtiene el ultimo id ingresado a la tabla empleado*/
        $last_id = $this->db->insert_id();
        return $last_id;
    }



    public function login_user($username, $password){
        $this->db->where('username', $username);
        $result = $this->db->get('users');

        $db_password = $result->row(2)->password;

        if(password_verify($password, $db_password)){
            return $result->row(0)->id;
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


    public function update_pass($user_id)
    {

        $options = ['cost'=>12];
        $encripted_pass = password_hash($this->input->post('nuevapass'), PASSWORD_BCRYPT,  $options);

        $data = array(
            'password'      => $encripted_pass
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);

        return TRUE;

    }

    public function get_users_info()
    {
        $this->db->from('users');
        $this->db->order_by('nombres','asc');

        $query = $this->db->get();

        if ($query->num_rows() < 1) {
            return FALSE;
        }

        return $query->result();
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