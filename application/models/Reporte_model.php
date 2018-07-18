<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 14/07/2018
 * Time: 10:01 AM
 */

class Reporte_model extends CI_Model
{

    /**
     * @param $intervalo
     * @return bool
     */
    public function IntervaloFijo($intervalo )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado

        if ($intervalo > 0 || $intervalo !=null)
        {
            //hoy
            if ($intervalo == 1)
            {
                $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = CURRENT_DATE');
                if($query->num_rows() > 0){
                    return $query->result();
                }
                return false;

            }
            //ayer
            if ($intervalo == 2)
            {
                $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = DATE(DATE(NOW())-1)');
                if($query->num_rows() > 0){
                    return $query->result();
                }
                return false;

            }


        }

    }
}