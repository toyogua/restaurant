<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 29/07/2018
 * Time: 12:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Errores extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('utilidades');

        if (!$this->session->userdata('logueado')){
            $this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }

    }

    /**
     *Devuelve vista de error no controlado en la aplicacion en general
     */
    public function errorFatal()
    {
        $data['main_view'] = "errores/fatal_error_view";
        $this->load->view('layouts/main', $data);
    }
}