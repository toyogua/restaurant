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
        $data['main_view'] = "orders/register_view";

        $this->load->view('layouts/main', $data);
    }

}