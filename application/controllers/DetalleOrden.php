<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class DetalleOrden extends CI_Controller
{

    public  function index()
    {
        //devuelve las categorias
        $data['categoria_data'] = $this->Categoria_model->get_categorias_info();

//        echo $this->Producto_model->get_productos_categoria(1);


        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

    public function updateDetalle($idDetalleOrden){
        if ($this->input->is_ajax_request()) {
            $data = $this->DetalleOrden_model->update($idDetalleOrden);
            echo json_encode($data);
        }
    }

}