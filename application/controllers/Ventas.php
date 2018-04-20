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

    }

    public function index()
    {

        $data['ordenes']    = $this->Venta_model->obtenerOrdenesApagar();
        $data['mesas']      = $this->Venta_model->obtenesMesasOcupadas();

        $data['main_view'] = "ventas/registrar_venta_view";

        $this->load->view('layouts/main', $data);
    }


    public function obtenerOrdenMesa()
    {

        $res = $this->Venta_model->obtenerOrden( $this->input->post('idmesa'));

        echo json_encode( $res );
    }

    public function update($id)
    {

        $data['main_view'] = "home_view";

        $this->load->view('layouts/main', $data);
    }

    public function delete($id)
    {

        $data['main_view'] = "home_view";

        $this->load->view('layouts/main', $data);
    }
}


//End of file locations application/controllers/Ventas.php