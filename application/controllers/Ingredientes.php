<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 10-Nov-17
 * Time: 2:17 PM
 */

class Ingredientes extends CI_Controller
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

    public function display( $porpagina = 20 , $desde = 0, $id = null ){
        //paginacion
        $elementos =  20;
        $data['porpagina'] = $elementos;
        $data['miurl'] = "ingredientes/display/";
        $data['paginas'] =  cuenta("Ingrediente", $elementos);

        //datos necesarios para la vista de form
        $data['placeholder'] = "Nombre Ingrediente";
        //variable que sera usara para redireccionar y tambien para completar la url para la busqueda
        $data['controlador'] = "Ingredientes/";
        //metodo que devuelve la vista donde se muestra la tabla con el item encontrado
        $data['metodo'] = "display";
        //campo de la tabla de la bd que se sera usado en el like de la funcion buscadorAjax del helper
        $data['campo'] = "ingrediente";
        //tabla que sera llamada  en la funcion buscadorAjax del helper
        $data['tabla'] = "ingrediente";
        //metodo del controlador que recibira la peticion ajax
        $data['buscador'] = "buscarIngrediente";

        $data['ingredientes_data'] = $this->Ingrediente_model->get_ingredientes_info( $porpagina, $desde, $id );
        $data['main_view'] = "ingredientes/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function get_ingrediente($idIngrediente){
        if ($this->input->is_ajax_request()) {
            $data = $this->Ingrediente_model->get_ingrediente_info($idIngrediente);
            echo json_encode($data);
        }
    }

    public function create(){
        $listaIngredientes = json_decode($_POST['ingredientes']);

        $data = array(
            'ingrediente'               => $listaIngredientes->ingrediente,
            'descripcionIngrediente'    => $listaIngredientes->ingredienteDescripcion,
            'costoIngrediente'          => $listaIngredientes->costoIngrediente,
            'cantIngrediente'           => $listaIngredientes->cantIngrediente,
            'fechaIngreso'              => $listaIngredientes->fechaIngreso,
            'medida'                    => $listaIngredientes->medida,
            'tipo'                      => $listaIngredientes->inventario
        );

        $res = $this->Ingrediente_model->insertIngredientes($data);
        echo json_encode($res);
    }


    public function edit(){
        $listaIngredientes = json_decode($_POST['ingredientes']);

        $data = array(
            'ingrediente'               => $listaIngredientes->ingrediente,
            'descripcionIngrediente'    => $listaIngredientes->ingredienteDescripcion,
            'costoIngrediente'          => $listaIngredientes->costoIngrediente,
            'cantIngrediente'           => $listaIngredientes->cantIngrediente,
            'fechaIngreso'              => $listaIngredientes->fechaIngreso,
            'medida'                    => $listaIngredientes->medida,
            'tipo'                      => $listaIngredientes->inventario
        );

        $res = $this->Ingrediente_model->edit_ingrediente($listaIngredientes->idingrediente, $data);
        echo json_encode($res);
    }

    public function delete($idIngrediente){
        $this->Ingrediente_model->delete_ingrediente($idIngrediente);
    }

    //metodouniversal para buscar
    //recibe desde ajax a traves de post los campos nombre, campo, tabla
    public  function buscarIngrediente(  )
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

                    <li style="cursor: pointer; padding-bottom: 10px; padding-top: 10px;" class="respuesta list-group-item list-group-item-action " data-id="<?php echo $fila->idIngrediente ?>"><?php echo $fila->ingrediente ?></li>

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