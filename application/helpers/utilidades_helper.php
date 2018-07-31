<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 27/05/2018
 * Time: 7:20 PM
 */
if(!function_exists('buscadorAjax')) {

    function buscadorAjax($nombre, $campo, $tabla)
    {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->like($campo, $nombre);
        $get_data = $CI->db->get($tabla, 3);

        if ($get_data->num_rows() < 1) {
            return false;
        }
        return $get_data->result();
    }
}

if(!function_exists('cuenta')) {
    function cuenta($tabla, $elementos)
    {
        $CI = &get_instance();
        $CI->load->database();

        $CI->db->from($tabla);
        $query = $CI->db->get();

        if ($query->num_rows() < 1) {
            return false;
        } else {

            $total_paginas = ceil($query->num_rows() / $elementos);
            return $total_paginas;

        }

    }
}

if(!function_exists('generador')) {
    function generador($valor, $porpagina)
    {
        if ($valor == 0) {
            $valor = 0;

        } else {
            $valor = $valor * $porpagina;
        }

        return $valor;

    }
}

if(!function_exists('obtenerPermisos')) {

    function obtenerPermisos($idempleado, $modulo, $accion)
    {
        $CI = & get_instance();
        $CI->load->database();

        $CI->db->where('id_empleado', $idempleado);
        $CI->db->where('id_modulo', $modulo);
        $CI->db->where('accion', $accion);
        $res = $CI->db->get('permisos_acciones');

        if ($res->num_rows() > 0) {
            return TRUE;
        }
    }
}

if(!function_exists('encuentraAccion')) {
    function encuentraAccion($buscar)
    {
        $res = FALSE;
        $CI = &get_instance();

        for ($i = 0; $i < count($CI->acciones); $i++) {
            if ($CI->acciones[$i]->accion == $buscar) {
                $res = TRUE;
            }
        }
        return $res;
    }
}

if(!function_exists('obtenerTotales')) {

    function obtenerTotales( $idmesa )
    {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->Venta_model;

        $res = $CI->Venta_model->obtenerOrden( $idmesa );

        if ($res != null )
        {
            $total = 0;
            foreach ($res as $item)
            {
                $subtotal = $item->cantDetalleOrden * $item->precioProducto;
                $total = $total + $subtotal;
            }

            return $total;
        }

        return 0;

    }
}

if(!function_exists('moneda')) {

    function moneda( $valor )
    {

        if ($valor != null )
        {

            return 'Q ' . number_format($valor, 2);
        }

        return 0;

    }
}


if(!function_exists('movimiento')) {

    function movimiento( $idempleado )
    {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->Caja_model;

        if ($idempleado != null )
        {
            $idmovimiento = $CI->Caja_model->obtenerMovimiento( $idempleado );

            if ($idmovimiento != FALSE && $idmovimiento != NULL)
            {
                return $idmovimiento;
            }else{

                return FALSE;
            }
        }

    }
}
