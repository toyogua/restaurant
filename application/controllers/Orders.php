<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Orders extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('utilidades');

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
    }

    public  function index()
    {
        $data['subcategorias_bebida'] = $this->Categoria_model->getSubCategoriaBebida();
        $data['subcategorias_comida'] = $this->Categoria_model->getSubCategoriaComida();


        $data['meseros_data'] = $this->Empleado_model->obtenerMeseros();
        $data['mesas_data'] = $this->Mesa_model->mesasdesocupadas();
        $data['mesas_ocupadas'] = $this->Mesa_model->mesasOcupadas();

        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

    public function insertarOrden()
    {
        $listaOrden = json_decode($_POST['orden']);
        $listaProducto = json_decode($_POST['detalle']);


        $res = $this->Orden_model->insertarOrden($listaOrden, $listaProducto);

        echo json_encode( $res );
    }

    public  function ordenes_categoria($fecha, $idCategoria)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->Orden_model->ordenes_categoria($fecha, $idCategoria);
            echo json_encode($data);
        }
    }

    public function display(){
        $data['categoria_data'] = $this->Categoria_model->categorias();

        $data['main_view'] = "orders/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function login()
    {
        $data['main_view'] = "orders/login_view";
        $this->load->view('layouts/main', $data);
    }




}