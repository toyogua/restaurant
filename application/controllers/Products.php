<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Products extends CI_Controller
{

    public  function obtener_productos_categoria($idCategoria)
    {
        if ($this->input->is_ajax_request()) {
//            $idCategoria = $this->input->post('id');
            $data = $this->Producto_model->get_productos_categoria($idCategoria);
            echo json_encode($data);
        }
    }

    public function display(){
        $data['productos_data'] = $this->Producto_model->get_productos_info();

        $data['main_view'] = "productos/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function get_producto($idProducto){
        if ($this->input->is_ajax_request()) {
            $data = $this->Producto_model->get_producto_info($idProducto);
            echo json_encode($data);
        }
    }

    public function create(){
        $listaProducto = json_decode($_POST['producto']);

        $data = array(
            'producto'               => $listaProducto->producto,
            'descripcionProducto'    => $listaProducto->descripcionProducto,
            'costoProducto'          => $listaProducto->costoProducto,
            'precioProducto'         => $listaProducto->precioProducto,
            'cantProducto'           => $listaProducto->cantProducto,
            'idCategoria'            => $listaProducto->idCategoria,
            'imagen'                 => $listaProducto->imagen
        );

        $this->Producto_model->insertProducto($data);
    }


    public function edit($idProducto){
        $listaProducto = json_decode($_POST['producto']);

        $data = array(
            'producto'               => $listaProducto->producto,
            'descripcionProducto'    => $listaProducto->descripcionProducto,
            'costoProducto'          => $listaProducto->costoProducto,
            'precioProducto'         => $listaProducto->precioProducto,
            'cantProducto'           => $listaProducto->cantProducto,
            'idCategoria'            => $listaProducto->idCategoria,
            'imagen'                 => $listaProducto->imagen
        );

        $this->Producto_model->edit_producto($idProducto, $data);
    }

    public function delete($idProducto){
        $this->Producto_model->delete_producto($idProducto);
    }


}