<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Mesas extends CI_Controller
{

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

}