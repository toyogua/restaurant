<?php

class Permisos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permisos_model');
        $this->load->model('User_model');
        $this->load->helper('utilidades_helper');


        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
    }

    public function index( $porpagina = 5, $desde = 0, $id = null )
    {
        //paginacion
        $elementos =  5;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "permisos/index/";
        $data['paginas'] =  cuenta("Permisos", $elementos);

        $data['users_data'] = $this->User_model->get_users_info( $porpagina, $desde, $id );
        
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
        $listpermisos   = json_decode($_POST['permisos']);
        $borrar         = json_decode( $_POST['borrar']);

        if ( $borrar != FALSE){
            foreach ( $borrar as $item )
            {

                if ( obtenerPermisos( $item->id_empleado, $item->id_modulo, $item->accion)){
                    $this->Permisos_model->eliminar( $item->id_empleado, $item->id_modulo, $item->accion);
                }
            }
        }


        foreach ( $listpermisos as $permiso)
        {
            $data = array(
                'id_empleado'   => $permiso->id_empleado,
                'id_modulo'     => $permiso->id_modulo,
                'accion'        => $permiso->accion
            );

            if (!obtenerPermisos($permiso->id_empleado, $permiso->id_modulo, $permiso->accion )){
                $this->Permisos_model->crear($data);
            }

        }

        echo json_encode( $res = TRUE);
    }
}