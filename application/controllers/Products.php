<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Products extends CI_Controller
{

    public  function obtener_productos_categoria($idCategoria)
    {
        if ($this->input->is_ajax_request()) {
//            $idCategoria = $this->input->post('id');
            $data = $this->Producto_model->get_productos_categoria($idCategoria);
            echo json_encode($data);
        }
    }

}