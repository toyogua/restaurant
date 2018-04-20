<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Categorias extends CI_Controller
{


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

    public function listarCategorias ()
    {
        $data['subcategorias_data'] = $this->Categoria_model->get_subcategorias_info();
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
        $res = $this->Categoria_model->get_subcategorias_info();

        echo json_encode( $res );
    }

}