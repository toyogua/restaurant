<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 29/07/2018
 * Time: 12:57 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Caja_model extends CI_Model
{
    public function apertura( $data)
    {
        if ( $data != NULL )
        {
            $this->db->insert('temp_movimientos', $data);
            return $this->db->insert_id();
        }else{
            return FALSE;

            redirect('errores/errorFatal');
        }
    }

    public function cierre( $data, $idcaja )
    {
        if ( $data != NULL )
        {
            $this->db->where('idtemp', $idcaja);
            $this->db->update('temp_movimientos', $data);

            $vieja = $this->ultimoTemporal( $idcaja );

            if ( $vieja != NULL){

                $data = array(
                    'apertura'      => $vieja->aperturaT,
                    'idEmpleado'    => $vieja->idempleadoT,
                    'montoApertura' => $vieja->montoAperturaT,
                    'montoCierre'   => $vieja->montoCierreT,
                    'idtemp'        => $vieja->idtemp,
                    'estado'        => 1

                );

                $this->removerInsertar( $data );

                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            redirect('errores/errorFatal');
        }
    }

    public function estado( $idempleado)
    {
        $this->db->where('idempleadoT', $idempleado);
        $this->db->where('borrado', 0 );
        $get_data = $this->db->get('temp_movimientos');

        if ($get_data->num_rows() < 1){
            //ninguna caja abierta con este idempleado
            return TRUE ;
        }
        //al menos una caja abierta con este idempleado, devuelve el id del movimiento temporal
        return FALSE;
    }

    public function obtenerMovimiento( $idempleado )
    {
        $this->db->where('idempleadoT', $idempleado);
        $this->db->where('borrado', 0 );
        $get_data = $this->db->get('temp_movimientos');

        if ($get_data->num_rows() > 0){
            //si encuentra al menos uno la tumpla completa
            return $get_data->row();
        }
        //nigun registro encotrando
        return FALSE;
    }

    public function ultimoTemporal( $idtemp )
    {
        $this->db->where('idtemp', $idtemp);
        $this->db->where('borrado', 1 );
        $get_data = $this->db->get('temp_movimientos');

        if ($get_data->num_rows() > 0){
            //si encuentra al menos uno la tumpla completa
            return $get_data->row();
        }
        //nigun registro encotrando
        return FALSE;
    }

    public function removerInsertar( $nueva)
    {
        $this->db->insert('movimientos_caja', $nueva);
        return TRUE;
    }
}