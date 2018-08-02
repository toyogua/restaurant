<?php
/**
 * Created by PhpStorm.
 * User: ROCKSOFT
 * Date: 10/04/2018
 * Time: 06:28 PM
 */

class Ventas extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('Venta_model');
        $this->load->model('Caja_model');
        $this->load->helper('utilidades');


        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }

    }

    public function index()
    {

        //$data['ordenes']    = $this->Venta_model->obtenerOrdenesApagar();
        $data['mesas']      = $this->Venta_model->obtenesMesasOcupadas();
        $data['main_view'] = "ventas/registrar_venta_view";

        $this->load->view('layouts/main', $data);
    }

    public  function  mesasOcupadas()
    {
        $res = $this->Venta_model->obtenesMesasOcupadas();

        echo json_encode( $res );
    }


    public function obtenerOrdenMesa()
    {

        $res = $this->Venta_model->obtenerOrden( $this->input->post('idmesa'));

        echo json_encode( $res );
    }

    public function pagarProductos()
    {

        $productos =    json_decode($_POST['productos']);
        $idempleado =   $this->input->post('idempleado');
        $total =        $this->input->post('total');

        date_default_timezone_set('America/Guatemala');
        //$hoy = date("Y-m-d H:i:s");
        //$hoy = date("Y-m-d");
        $fecha = date("Y-m-d");

        $data = array(
            'idempleado'                => $idempleado,
            'fecha'                     => $fecha,
            'total'                     => $total,
            'estado'                    => 1
        );

        $idventa = $this->Venta_model->insertarVenta( $data );

        foreach($productos as $producto)
        {

            $arrproductos = array(

                'idproducto'            => $producto->idproducto,
                'idventa'               => $idventa,
                'cantidad'              => $producto->cantidad
            );

            $this->Venta_model->insertaDetalleVenta( $arrproductos );

            $datadetalle = array(
              'pagado'      => 1,

            );
            $this->Venta_model->marcaProductoDetalleOrden($producto->idproducto, $producto->idorden, $datadetalle);
        }

    }

    public function marcarComoPagada()
    {
        $idmesa = $this->input->post('idmesa');

        $data = array(
            'estadoOrden'   => 1,
            'pagada'        => 1
        );

        $this->Venta_model->marcarOrden($data, $idmesa);

        $datamesa = array(
            'ocupada' => 0
        );

        $res = $this->Venta_model->marcarDesocupadaMesa( $datamesa, $idmesa);

        echo json_encode( $res );
    }

    public function delete($id)
    {

        $data['main_view'] = "home_view";

        $this->load->view('layouts/main', $data);
    }
}


//End of file locations application/controllers/Ventas.php