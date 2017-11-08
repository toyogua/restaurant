<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class DetalleProducto extends CI_Controller
{

    public  function obtener_detalle($idProducto)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->DetalleProducto_model->get_ingredientes_producto($idProducto);
            echo json_encode($data);
        }

    }

}