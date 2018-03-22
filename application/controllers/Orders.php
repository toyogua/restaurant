<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Orders extends CI_Controller
{

    public  function index()
    {
        $bebida = "bebida";
        $comida = "comida";

        $data['categorias_bebida'] = $this->Categoria_model->getCategoriaBebida($bebida);
        $data['categorias_comida'] = $this->Categoria_model->getCategoriaComida($comida);

        $data['categoria_data'] = $this->Categoria_model->get_categorias_info();//obtiene las categorias
        $data['meseros_data'] = $this->Empleado_model->get_empleados_info();//obtiene los empleados
        $data['mesas_data'] = $this->Mesa_model->get_mesas_info();//obtiene las mesas

        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

    public function insertarOrden()
    {
        $listaOrden = json_decode($_POST['orden']);
        $listaProducto = json_decode($_POST['detalle']);


        $this->Orden_model->insertarOrden($listaOrden, $listaProducto);

    }

    public  function ordenes_categoria($fecha, $idCategoria)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->Orden_model->ordenes_categoria($fecha, $idCategoria);
            echo json_encode($data);
        }
    }

    public function display(){
        $data['categoria_data'] = $this->Categoria_model->get_categorias_info();

        $data['main_view'] = "orders/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function login()
    {
        $data['main_view'] = "orders/login_view";
        $this->load->view('layouts/main', $data);
    }




}