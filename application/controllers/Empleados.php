<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Empleados extends CI_Controller
{

    function __construct() {

        parent::__construct();

        $this->load->model('User_model');
        $this->load->helper('utilidades_helper');

        if (!$this->session->userdata('logueado')){
            //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
            redirect('home');
        }

    }

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

    public function getTipoEmpleado(){
        $data = $this->Empleado_model->todosTipos();
        echo json_encode($data);
    }

    public function crearEmpleado()
    {
        $nombre     = $this->input->post('txtNombreEmpleado');
        $apellido   = $this->input->post('txtApellidoEmpleado');
        $direccion  = $this->input->post('txtDirecionEmpleado');
        $telefono   = $this->input->post('txtTelefonoEmpleado');
        $email      = $this->input->post('txtEmailEmpleado');
        $idtipo     = $this->input->post('idTipoEmpleado');
        $clave      = $this->input->post('txtClaveEmpleado');

        $numero = rand(1, 100);
        $cadena = substr($nombre, 0, 3);
        $username = $cadena.$numero;


        //idTurno solo se manda el 1 para mientras se genera el dropdown para elegirlo en la vista
        $dataempleado = array(

                'nombresEmpleado'   => $nombre,
                'apellidosEmpleado' => $apellido,
                'direccionEmpleado' => $direccion,
                'telefonoEmpleado'  => $telefono,
                'emailEmpleado'     => $email,
                'idTipoEmpleado'    => $idtipo,
                'idTurno'           => 1,
                'estado'            => 1
        );

        $options = ['cost'=>12];
        $claveencriptada = password_hash($clave, PASSWORD_BCRYPT,  $options);

        $idinsertado = $this->Empleado_model->crearEmpleado($dataempleado);

        $datauser = array(
                'username'          => $username,
                'password'          => $claveencriptada,
                'idEmpleado'        => $idinsertado,
                'estado'            => 1
        );

        $res = $this->User_model->create_user( $datauser );

        echo json_encode( $res );

    }

    public function getEmpleadoInfo( $idempleado )
    {
        $data = $this->Empleado_model->empleadoInfo( $idempleado );

        echo json_encode( $data );
    }

    public function editarEmpleado()
    {
        $nombre     = $this->input->post('txtNombreEmpleado');
        $apellido   = $this->input->post('txtApellidoEmpleado');
        $direccion  = $this->input->post('txtDirecionEmpleado');
        $telefono   = $this->input->post('txtTelefonoEmpleado');
        $email      = $this->input->post('txtEmailEmpleado');
        $idtipo     = $this->input->post('idTipoEmpleado');
        $clave      = $this->input->post('txtClaveEmpleado');
        $id         = $this->input->post('txtIdEmpleado');

        $username   = $this->input->post('txtUsername');

        $options = ['cost'=>12];
        $claveencriptada = password_hash($clave, PASSWORD_BCRYPT,  $options);

        $dataempleado = array(
            'nombresEmpleado'   => $nombre,
            'apellidosEmpleado' => $apellido,
            'direccionEmpleado' => $direccion,
            'telefonoEmpleado'  => $telefono,
            'emailEmpleado'     => $email,
            'idTipoEmpleado'    => $idtipo,
            'idTurno'           => 1,
            'estado'            => 1
        );

        $this->Empleado_model->actualizarEmpleado( $dataempleado, $id );

        $datausuario = array(
                'username'      => $username,
                'password'      => $claveencriptada,

        );

        $res = $this->User_model->update_pass( $datausuario, $id );
        echo json_encode( $res );
    }

    public function eliminar()
    {
        $id = $this->input->post('id');

        $data = array(
                'estado'    => 0
        );
        $this->Empleado_model->eliminarEmpleado($data, $id);

        $res = $this->User_model->delete_user( $data, $id );


        echo json_encode( $res );
    }

    public function tipos()
    {
        $data['data_tipos'] = $this->Empleado_model->todosTipos();
        $data['main_view'] = "users/listar_tipos_view";
        $this->load->view('layouts/main', $data);
    }

    public function crearTipoEmpleado()
    {
        $nombre = $this->input->post('txtNombreTipoEmpleado');

        $data = array(
                'tipoEmpleado'  => $nombre,
                'idCategoria'   => 1,
                'estado'        => 1
        );
        $res = $this->Empleado_model->crearTipo( $data );

        echo json_encode( $res );
    }

    public function getTipo( $id )
    {
        $res = $this->Empleado_model->tipoInfo( $id );

        echo json_encode( $res );
    }

    public function editarTipo()
    {
        $data = array(
                'tipoEmpleado'      =>  $this->input->post('txtNombreTipoEmpleado')
        );

        $res = $this->Empleado_model->actualizarTipo( $this->input->post('txtIdTipo'), $data );

        echo json_encode( $res );
    }

    public function borrarTipo()
    {
        $id = $this->input->post('id');

        $data = array(
                'estado'    => 0
        );

        $res = $this->Empleado_model->eliminarTipo( $id, $data );


        echo json_encode( $res );
    }

}