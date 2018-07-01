<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Categorias extends CI_Controller
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


    public  function buscarCategorias()
    {
        $categoria = $this->input->post('nombre');

        $data = $this->Categoria_model->buscarCategoria($categoria);

        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

                <div  id="respuesta" class="list-group" >

                    <span class="categoria cargarCategoria list-group-item list-group-item-action" data-id="<?php echo $fila->idCategoria ?>" data-nombre="<?php echo $fila->categoria ?>" ><?php echo $fila->categoria ?></span>

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

    public  function getCategoria($idCategoria)
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->Categoria_model->getCategoria($idCategoria);
            echo json_encode($data);
        }
    }

    public function listarCategorias ( $porpagina = 5 , $desde = 0 )
    {
        //paginacion

        $elementos =  5;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "categorias/listarCategorias/";
        $data['paginas'] =  cuenta("categoria", $elementos);

        //datos necesarios para la vista de form
        $data['placeholder'] = "Nombre Subategoria";
        //variable que sera usara para redireccionar y tambien para completar la url para la busqueda
        $data['controlador'] = "categorias/";
        //metodo que devuelve la vista donde se muestra la tabla con el item encontrado
        $data['metodo'] = "listarCategorias";
        //campo de la tabla de la bd que se sera usado en el like de la funcion buscadorAjax del helper
        $data['campo'] = "nombre";
        //tabla que sera llamada  en la funcion buscadorAjax del helper
        $data['tabla'] = "subcategorias";
        //metodo del controlador que recibira la peticion ajax
        $data['buscador'] = "buscarSubCategoria";

        $data['subcategorias_data'] = $this->Categoria_model->get_subcategorias_info( $porpagina, $desde );
        $data['main_view'] = "categorias/listar_subcategorias";
        $this->load->view('layouts/main', $data);
    }

    public function create()
    {
        $nombresubcategoria        = $this->input->post('txtNombreCategoria');

        $idcategoria            = $this->input->post('idcategoria');

        $data = array(
            'nombre'               => $nombresubcategoria,
            'idCategoria'          => $idcategoria,
            'estado'               => 1

        );

        $res = $this->Categoria_model->insertarSubCategoria($data);
        echo json_encode($res);
    }

    public function getSubCategoriaInfo( $idsubcategoria )
    {
        $data = $this->Categoria_model->getSubCategoriaInfo( $idsubcategoria );
        echo json_encode($data);
    }

    public function edit()
    {
        $nombresubcategoria        = $this->input->post('nombre');

        $idsubcategoria            = $this->input->post('subcategoria');

        $idcategoria               = $this->input->post('idcategoria');

        $data = array(
            'nombre'               => $nombresubcategoria,
            'idCategoria'          => $idcategoria,
            'estado'               => 1

        );

        $res = $this->Categoria_model->udpateSubCategoria( $data, $idsubcategoria);

        echo json_encode( $res );
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $data = array(
                'estado'    => 0
        );
        $res = $this->Categoria_model->deleteSubCategoria( $data, $id);

        echo json_encode( $res );
    }

    /**
     * @descr-devuelve todas las categorias en notacion json
     *
     */
    public function todasLasCategorias(  )
    {
        $res = $this->Categoria_model->categorias();

        echo json_encode( $res );


    }

    public function todasSubCategoriasJSON()
    {
        $res = $this->Categoria_model->get_subcategoriasJSON();

        echo json_encode( $res );
    }

    public function buscarSubCategoria()
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

                <li style="cursor: pointer; padding-bottom: 10px; padding-top: 10px;" class="respuesta list-group-item list-group-item-action " data-id="<?php echo $fila->idSubcategoria ?>"><?php echo $fila->nombre ?></li>

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