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
    public function IntervaloFijo($intervalo, $fInicial, $fFinal )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado
        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = CURRENT_DATE');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = DATE(DATE(NOW())-1)');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE YEARWEEK(fecha) = YEARWEEK(CURDATE());');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE fecha >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND fecha < curdate() - INTERVAL DAYOFWEEK(curdate())-2 DAY');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE fecha BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE MONTH(fecha) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH));');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE YEAR(fecha) = YEAR(CURDATE())');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE YEAR(fecha) = YEAR(NOW()) - 1');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return false;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){
                $condition = "fecha BETWEEN " . "'" . $fInicial . "'" . " AND " . "'" . $fFinal . "'";



                $this->db->from('ventas');

                $this->db->where($condition);

                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return false;
                }
            }

    }
}