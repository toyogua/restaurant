<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class DetalleOrden extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('permisos_helper');
    }

    public  function index()
    {
        $data['categoria_data'] = $this->Categoria_model->get_categorias_info();
        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

    public function updateDetalle(){

        $orden = $this->input->post('idDetalleOrden');
        $mesa = $this->input->post('idmesa');
        if ($this->input->is_ajax_request()) {
            $data = $this->DetalleOrden_model->update($orden);
            echo json_encode($data);
        }

//        $data2 = array(
//            'ocupada'   => 0
//        );

        //$this->Mesa_model->actualizarMesa( $data2, $mesa);
    }

}