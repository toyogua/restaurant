<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 14/07/2018
 * Time: 9:57 AM
 */

class Reportes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('utilidades');


        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
    }

    //Pantalla principal para los reportes
    public function index()
    {

    }
}