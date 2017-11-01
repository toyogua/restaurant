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

        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

}