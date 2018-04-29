
<?php
/**
 * Created by PhpStorm.
 * User: bugh0st
 * Date: 4/28/18
 * Time: 11:48 a.m.
 */

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


function encuentraAccion( $buscar )
{
    $res = FALSE;
    $CI = & get_instance();

    for ($i = 0; $i < count( $CI->acciones ); $i++) {
                        if( $CI->acciones[$i]->accion == $buscar){
                            $res = TRUE;
                        }
                    }
    return $res;
}
