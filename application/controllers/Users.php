<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


    function __construct() {

        parent::__construct();

        $this->load->model('User_model');

    }


    public function display(){

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        if($this->User_model->get_users_info()){
            $data['users_data'] = $this->User_model->get_users_info();
        }
        $data['main_view'] = "users/display_view";//direccion de la vista
        $this->load->view('layouts/main', $data);
    }

    public function register(){

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('username', 'Nombre de Usuario', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirmar Contraseña', 'trim|required|min_length[3]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['main_view'] = 'users/register_view';
            $this->load->view('layouts/main', $data);
        } else {
            if($this->User_model->create_user()){
                $this->session->set_flashdata('user_registered', 'Usuario Registrrado');
                redirect('users/display');
            }else{

            }

        }
    }

    public function delete($idUser){

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        $this->User_model->delete_user($idUser);
        $this->session->set_flashdata('user_deleted','El Usuario ha sido eliminado');
        redirect('users/display');

    }

    public function edit($id){

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]');

        if($this->form_validation->run() == FALSE){
            $data['user_data'] = $this->User_model->get_user_info($id);
            $data['main_view'] = "users/edit_view";//direccion de la vista
            $this->load->view('layouts/main', $data);


        }else {
                $data = array(
                    'nombres'       => $this->input->post('nombres'),
                    'apellidos'     => $this->input->post('apellidos'),
                    'email'         => $this->input->post('email'),
                    'username'      => $this->input->post('username'),
                );


                if($this->User_model->edit_user($id, $data)){
                    $this->session->set_flashdata('user_updated','El Usuario ha sido modificado con éxito');
                    redirect('users/display');
                }

//            if($this->input->post('reset')){
//                $user_id = $id;
//
//                if ($this->User_model->update_pass($user_id)) {
//
//                    $this->session->set_flashdata('password_updated','La clave y usuario han sido modificados con éxito');
//                    redirect('users/edit/'.$idUser);
//                }
//            }

        }

    }


    public function login()
    {

        //$this->load->model('user_model');

        $this->form_validation->set_rules('username', 'Nombre de Usuario', 'trim|required|min_length[3]');

        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[3]');


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('home');

        } else {
            if($this->input->post('username') && $this->input->post('password')){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                var_dump($username);

                $user_id = $this->User_model->login_user($username, $password);

                if ($user_id) {
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_admin' => true
                    );

                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('login_success', 'Bienvenido al sistema');

                    $data['main_view'] = "home_view";
                    $this->load->view('layouts/main', $data);

                    redirect('home');
                } else {
                    $this->session->set_flashdata('login_failed', 'Lo sentimos, no lograste ingresar al sistema');
                    redirect('home');
                }

            }
        }

    }

    //Cambio de clave
    public function update_pass()
    {

        $this->form_validation->set_rules('nuevapass', 'Nueva clave', 'trim|required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $data['main_view'] = 'users/reset_view';
            $this->load->view('layouts/main', $data);
        }
        else{

            $user_id = $this->session->userdata('user_id');

            if ($this->User_model->update_pass($user_id)) {

                $this->session->sess_destroy();
//                echo "Clave cambiada éxitosamente";
                redirect('home/index');
            }
        }
    }



    public function logout(){

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        $this->session->sess_destroy();
        redirect('home');
    }

}