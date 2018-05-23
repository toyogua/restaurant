<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 23/05/2018
 * Time: 3:15 PM
 */

if(!function_exists('obtenerTotales')) {

    function obtenerTotales( $idmesa )
    {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->Venta_model;

        $res = $CI->Venta_model->obtenerOrden( $idmesa );

        $total = 0;
        foreach ($res as $item)
        {
            $subtotal = $item->cantDetalleOrden * $item->precioProducto;
            $total = $total + $subtotal;
        }

        return $total;
    }
}

