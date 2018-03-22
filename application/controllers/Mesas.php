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

    public function listar()
    {
        $data['mesas_data'] = $this->Mesa_model->get_mesas_info();

        $data['main_view'] = "mesas/listar_mesas_view";
        $this->load->view('layouts/main', $data);
    }

    public function crear()
    {
        $data = array(
                'noMesa'            => $this->input->post('iptNumeroMesa'),
                'ubicacionMesa'     => $this->input->post('txtUbicacionMesa'),
                'descripcionMesa'   => $this->input->post('txtDescripcionMesa'),
                'ocupada'           => 0,
                'estado'            => 1
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

}