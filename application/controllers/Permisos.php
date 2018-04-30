<?php

class Permisos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permisos_model');
        $this->load->model('User_model');
        $this->load->helper('permisos_helper');
    }

    public function index()
    {
        $data['users_data'] = $this->User_model->get_users_info();
        
        $data['main_view'] = "permisos/index";
        $this->load->view('layouts/main', $data);

    }

    public function asignar($idempleado)
    {


        $data['acciones_ordenes']   = $this->Permisos_model->accionesOrdenes();
        $data['acciones_empleados'] = $this->Permisos_model->accionesEmpleados();
        $data['acciones_mesas']     = $this->Permisos_model->accionesMesas();
        $data['acciones_ventas']    = $this->Permisos_model->accionesVentas();

        $data['idempleado']         = $idempleado;


        $data['main_view'] = "permisos/asignar";
        $this->load->view('layouts/main', $data);
    }

    public function insertarPermisos()
    {
        $listpermisos = json_decode($_POST['permisos']);

        foreach ( $listpermisos as $permiso)
        {
            $data = array(
                'id_empleado'   => $permiso->id_empleado,
                'id_modulo'     => $permiso->id_modulo,
                'accion'        => $permiso->accion
            );

            $this->Permisos_model->crear($data);
        }
    }
}