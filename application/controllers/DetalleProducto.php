<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class DetalleProducto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('utilidades_helper');

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
    }

    public  function obtener_detalle($idProducto)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->DetalleProducto_model->get_ingredientes_producto($idProducto);
            echo json_encode($data);
        }

    }

}