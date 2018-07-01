<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Mesas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('utilidades_helper');

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }
    }

    public  function buscarMesas()
    {
        $noMesa = $this->input->post('nombre');

        $data = $this->Mesa_model->buscarMesa($noMesa);

        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

                <div  id="respuesta" class="list-group" >

                    <span class="mesa cargarMesa list-group-item list-group-item-action" data-id="<?php echo $fila->idMesa ?>" data-nombre="<?php echo $fila->noMesa ?>" ><?php echo $fila->noMesa ?></span>

                </div>


                <?php
            }

            //en otro caso decimos que no hay resultados
        }else{
            ?>

            <p><?php echo 'No hay resultados' ?></p>

            <?php
        }

    }

    public  function getMesa($idMesa)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->Mesa_model->getMesa($idMesa);
            echo json_encode($data);
        }
    }

    public function listar($porpagina = 5 , $desde = 0, $id = null )
    {
        $elementos =  5;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "mesas/listar/";
        $data['paginas'] =  cuenta("mesa", $elementos);

        //datos necesarios para la vista de form
        $data['placeholder'] = "No Mesa";
        //variable que sera usara para redireccionar y tambien para completar la url para la busqueda
        $data['controlador'] = "mesas/";
        //metodo que devuelve la vista donde se muestra la tabla con el item encontrado
        $data['metodo'] = "listar";
        //campo de la tabla de la bd que se sera usado en el like de la funcion buscadorAjax del helper
        $data['campo'] = "noMesa";
        //tabla que sera llamada  en la funcion buscadorAjax del helper
        $data['tabla'] = "mesa";
        //metodo del controlador que recibira la peticion ajax
        $data['buscador'] = "buscarMesa";

        $data['mesas_data'] = $this->Mesa_model->get_mesas_info( $porpagina, $desde, $id );
        $data['main_view'] = "mesas/listar_mesas_view";
        $this->load->view('layouts/main', $data);
    }

    public function ocupadas( $porpagina = 5 , $desde = 0 )
    {
        //paginacion
        $elementos =  5;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "mesas/ocupadas/";
        $data['paginas'] =  cuenta("Mesa", $elementos);


        $data['mesas_data'] = $this->Mesa_model->getMesasConOrdenes( $porpagina, $desde);

        $data['main_view'] = "mesas/listar_mesas_con_ordenes_view";
        $this->load->view('layouts/main', $data);
    }


    public function crear()
    {
        $data = array(
                'noMesa'            => $this->input->post('iptNumeroMesa'),
                'ubicacionMesa'     => $this->input->post('txtUbicacionMesa'),
                'descripcionMesa'   => $this->input->post('txtDescripcionMesa')
        );

        $res = $this->Mesa_model->crearMesa( $data );

        echo json_encode( $res );
    }

    public function getMesaInfo ( $id )
    {
        $res = $this->Mesa_model->obtenerMesa( $id );

        echo json_encode( $res );
    }

    public function editar()
    {
        $id = $this->input->post('txtIdMesa');
        $data = array(
            'noMesa'            => $this->input->post('iptNumeroMesa'),
            'ubicacionMesa'     => $this->input->post('txtUbicacionMesa'),
            'descripcionMesa'   => $this->input->post('txtDescripcionMesa'),
            'ocupada'           => 0,
            'estado'            => 1
        );

        $res = $this->Mesa_model->actualizarMesa( $data, $id);

        echo json_encode( $res );
    }

    public function eliminar()
    {
        $data = array(
                'estado'        => 0
        );

        $res = $this->Mesa_model->eliminarMesa( $data, $this->input->post('id'));

        echo json_encode( $res );
    }

    public  function verMesaOrden()
    {
        $idmesa = $this->input->post('idmesa');
        $res = $this->Mesa_model->mesaConOrden( $idmesa );

        echo json_encode( $res );
    }

    public function buscarMesa()
    {
        $nombre = $this->input->post('nombre');
        $campo = $this->input->post('campo');
        $tabla = $this->input->post('tabla');

        $data = buscadorAjax( $nombre, $campo, $tabla );
        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

                <li style="cursor: pointer; padding-bottom: 10px; padding-top: 10px;" class="respuesta list-group-item list-group-item-action " data-id="<?php echo $fila->idMesa ?>"><?php echo $fila->noMesa ?></li>

                <?php
            }

            //en otro caso decimos que no hay resultados
        }else{
            ?>

            <p><?php echo 'No hay resultados' ?></p>

            <?php
        }
    }

}