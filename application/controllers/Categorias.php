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
            $data = $this->Cateogria_model->getCategoria($idCategoria);
            echo json_encode($data);
        }
    }

}