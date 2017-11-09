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
        //devuelve las categorias
        $data['categoria_data'] = $this->Categoria_model->get_categorias_info();

//        echo $this->Producto_model->get_productos_categoria(1);


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

}