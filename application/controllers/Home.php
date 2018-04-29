<?php

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('permisos_helper');
    }

    public  function index()
    {
        $data['main_view'] = "home_view";

        $this->load->view('layouts/main', $data);
    }

}