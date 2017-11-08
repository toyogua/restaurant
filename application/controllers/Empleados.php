<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Empleados extends CI_Controller
{

    public  function buscarMesero()
    {
        $nombreMesero = $this->input->post('nombre');

        $data = $this->Empleado_model->buscarEmpleado($nombreMesero);

        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

                <div  id="respuesta" class="list-group" >

                    <span class="mesero cargarMesero list-group-item list-group-item-action" data-id="<?php echo $fila->idEmpleado ?>" data-nombre="<?php echo $fila->nombresEmpleado ?>" ><?php echo $fila->nombresEmpleado ?></span>

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

}