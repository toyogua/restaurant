<?php
/**
 * Created by PhpStorm.
 * User: ROCKSOFT
 * Date: 03/01/2018
 * Time: 08:47 AM
 */
function paginar_todo( $tabla, $pagina, $por_pagina = 20, $campos = array())
{

    //refenciamos a la instancia con el puntero, para poder acceder a los metodos
    $CI = & get_instance();
    $CI->load->database();

    if (!isset($por_pagina)){

        $por_pagina = 20;
    }

    if (!isset($pagina)){

        $pagina = 1;
    }
    $cuantos = $CI->db->count_all($tabla);
    //ceil sirve para redondeo
    $total_paginas = ceil($cuantos/$por_pagina);

    if ($pagina > $total_paginas)
    {
        $pagina = $total_paginas;
    }

    //si se envia uno en la url le restamos -1 para sea 0
    $pagina -= 1;
    //si quiere la pagina 2, 2-1 es igual a 1, y 20*1=20
    $desde = $pagina * $por_pagina;

    if ($pagina >= $total_paginas - 1){
        $pag_siguiente = 1;
    }else{
        $pag_siguiente = $pagina + 2;
    }

    if ($pagina < 1){
        $pagina_anterior = $total_paginas;
    }else{
        $pagina_anterior = $pagina;
    }

    $CI->db->select($campos);
    $query = $CI->db->get($tabla, $por_pagina, $desde);
    $respuesta = array(
        'err'   => FALSE,
        'cuantos'=> $cuantos,
        'total_paginas'=> $total_paginas,
        'pag_actual'    => ($pagina + 1),
        'pag_siguiente' => $pag_siguiente,
        'pag_anterior'   => $pagina_anterior,
        $tabla      => $query->result()
    );

    return $respuesta;
}