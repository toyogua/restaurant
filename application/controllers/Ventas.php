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

    }

    public function index()
    {



        $data['main_view'] = "ventas/registrar_venta_view";

        $this->load->view('layouts/main', $data);
    }


    public function create($id)
    {

        $data['main_view'] = "home_view";

        $this->load->view('layouts/main', $data);
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