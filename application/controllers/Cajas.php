<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 29/07/2018
 * Time: 12:33 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Cajas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('utilidades');
        $this->load->model('Caja_model');
        $this->load->model('Reporte_model');

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }


    }


    /**
     * Crea un registro en la bd para aperturar caja por empleado
     */
    public function aperturaCaja()
    {
        $idempleado = $this->input->post('idempleado');
        $montoapertura = $this->input->post('monto');

        if ( $idempleado !=  NULL && $montoapertura != NULL )
        {

            $data = array(
                'idEmpleadoT'       => $idempleado,
                'montoAperturaT'    => $montoapertura

            );

            $ultimomovimiento = $this->Caja_model->apertura($data);

            echo json_encode( $ultimomovimiento );

        }else{
            redirect('errores/errorFatal');
        }

        //echo json_encode( $ultimomovimiento );
    }

    public function cierreCaja()
    {
        $idcaja = $this->input->post('idcaja');
        $idempleado = $this->input->post('idempleado');
        $montocierre = $this->input->post('monto');

        if ( $idempleado !=  NULL && $montocierre != NULL && $idcaja != NULL )
        {
            $data = array(
                'montoCierreT'     => $montocierre,
                'borrado'          => 1,

            );

            $res = $this->Caja_model->cierre( $data, $idcaja );


        }else{

            redirect('errores/errorFatal');
        }

        echo json_encode( $res );
    }

    public function obtenerEstado()
    {
        $idempleado = $this->input->post('id');

        if ( $idempleado != null){

            $res = $this->Caja_model->estado( $idempleado );

            echo json_encode( $res );
        }else{
            redirect('errores/errorFatal');
        }

    }

//    public function movimiento()
//    {
//        $idempleado = $this->input->post('idempleado');
//
//        if ( $idempleado != NULL)
//        {
//            $idmovimiento = $this->Caja_model->obtenerMovimiento( $idempleado );
//
//            echo json_encode( $idmovimiento );
//        }else{
//            redirect('errores/errorFatal');
//        }
//    }

    public function cierreContraVenta()
    {
        date_default_timezone_set('America/Guatemala');
        //$hoy = date("Y-m-d H:i:s");
        $hoy = date("Y-m-d");


        $idempleado = $this->input->post('idempleado');
        $fInicial = $this->Caja_model->obtenerMovimiento( $idempleado );

        $formateada = date("Y-m-d", strtotime($fInicial->aperturaT));

        $total = $this->Reporte_model->ventasCierreCaja($formateada, $hoy, $idempleado );

        //enviamos dos datos parseados de dos formas diferentes, uno para insercion y otro para mostrar al usuario
        $res = array(
          'montobd'     =>      $total[0]->total,
          'montotxt'    =>     moneda( $total[0]->total )
        );
        echo json_encode( $res );

    }
}