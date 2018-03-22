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
        $data['categorias_data'] = $this->Categoria_model->get_categorias_info();
        $data['main_view'] = "categorias/listar_categorias";
        $this->load->view('layouts/main', $data);
    }

    public function create()
    {
        $nombrecategoria        = $this->input->post('txtNombreCategoria');
        $descripcioncategoria   = $this->input->post('txtDescripcionCategoria');

        $data = array(
            'categoria'               => $nombrecategoria,
            'descripcionCategoria'      => $descripcioncategoria

        );

        $res = $this->Categoria_model->insertarCategoria($data);
        echo json_encode($res);
    }

    public function getCategoriaInfo( $idcategoria )
    {
        $data = $this->Categoria_model->getCategoriaInfo( $idcategoria );
        echo json_encode($data);
    }

    public function edit()
    {
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $idcategoria = $this->input->post('idcategoria');

        $data = array(
                'categoria'             => $nombre,
                'descripcionCategoria'  => $descripcion
        );

        $res = $this->Categoria_model->udpateCategoria( $data, $idcategoria);

        echo json_encode( $res );
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $res = $this->Categoria_model->deleteCategoria($id);

        echo json_encode( $res );
    }


}