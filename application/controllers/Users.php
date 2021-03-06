<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model('User_model');
        $this->load->helper('utilidades_helper');

    }


    public function display( $porpagina = 5 , $desde = 0, $id = null ){

        //paginacion
        $elementos =  5;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "users/display/";
        $data['paginas'] =  cuenta("Empleado", $elementos);

        //datos necesarios para la vista de form
        $data['placeholder'] = "Nombre Empleado";
        //variable que sera usara para redireccionar y tambien para completar la url para la busqueda
        $data['controlador'] = "Users/";
        //metodo que devuelve la vista donde se muestra la tabla con el item encontrado
        $data['metodo'] = "display";
        //campo de la tabla de la bd que se sera usado en el like de la funcion buscadorAjax del helper
        $data['campo'] = "nombresEmpleado";
        //tabla que sera llamada  en la funcion buscadorAjax del helper
        $data['tabla'] = "empleado";
        //metodo del controlador que recibira la peticion ajax
        $data['buscador'] = "buscarEmpleado";

        $data['users_data'] = $this->User_model->get_users_info( $porpagina, $desde, $id );


        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }


        
        $data['main_view'] = "users/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function register(){

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
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

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }

        if (!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('no_access', 'No estas autorizado para ingresar a esta dirección!');
            redirect('home');
        }

        $this->User_model->delete_user($idUser);
        $this->session->set_flashdata('user_deleted','El Usuario ha sido eliminado');
        redirect('users/display');

    }

    public function edit($id){

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }

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
        }

    }


    public function login()
    {


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
                $usuario = $this->User_model->login_user($username, $password);

                if ($usuario) {

                        $user_data = array(
                            'user_id'       => $usuario->idUser,
                            'username'      => $username,
                            'nombre'        => $usuario->nombresEmpleado.' '.$usuario->apellidosEmpleado,
                            'logueado'      => true,
                            'tipoempleado'  => $usuario->idTipoEmpleado,
                            'role'          => $usuario->tipoEmpleado,
                            'idempleado'    => $usuario->idEmpleado,


                        );

                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('login_success', 'Bienvenido al sistema '. $usuario->nombresEmpleado.' '.$usuario->apellidosEmpleado);

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

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
        $this->form_validation->set_rules('nuevapass', 'Nueva clave', 'trim|required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {

            $data['main_view'] = 'users/reset_view';
            $this->load->view('layouts/main', $data);
        }
        else{

            $user_id = $this->session->userdata('user_id');

            if ($this->User_model->update_pass($user_id)) {

                $this->session->sess_destroy();
                redirect('home');
            }
        }
    }



    public function logout(){

        $this->session->sess_destroy();
        redirect('home');
    }

    public function buscarEmpleado()
    {
        $nombre = $this->input->post('nombre');
        $campo = $this->input->post('campo');
        $tabla = $this->input->post('tabla');

        $data = buscadorAjax( $nombre, $campo, $tabla );
        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

                <li style="cursor: pointer; padding-bottom: 10px; padding-top: 10px;" class="respuesta list-group-item list-group-item-action " data-id="<?php echo $fila->idEmpleado ?>"><?php echo $fila->nombresEmpleado ?></li>

                <?php
            }

            //en otro caso decimos que no hay resultados
        }else{
            ?>

            <p><?php echo 'No hay resultados' ?></p>

            <?php
        }
    }

}