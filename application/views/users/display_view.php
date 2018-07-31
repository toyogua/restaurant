<h2 align="center">EMPLEADOS </h2>
<hr>
<div class="row">
    <div class="col-md-2">
        <!-- Button trigger modal -->
        <button style="cursor: pointer;" id="btnNuevoEmpleado" type="button" class="btn btn-success" data-toggle="modal" data-target="#mNuevoEmpleado">
            <i class="fa fa-plus"></i>Nuevo Empleado
        </button>
    </div>
    <div>
        <?php $this->load->view('layouts/paginacion_view'); ?>
    </div>

    <?php $this->load->view('layouts/form_view'); ?>

</div>



<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mNuevoEmpleado" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog moda-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4   class="modal-title font-weight-bold" id="productoModalLabel">Nuevo Empleado</h4>
            </div>
            <div class="modal-body">
                <div id="divFormCrearEmpleado">

                </div>

            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarRegistrarEmpleado" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnRegistrarEmpleado">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Editar Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divFormEditarEmpleado">

                </div>

            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarEmpleado" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnEditarEmpleaddo">Editar</button>
            </div>
        </div>
    </div>
</div>




<table class="table table-bordered table-striped listadoproductos">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            NOMBRE
        </th>


        <th class="text-center">
            TELEFONO
        </th>


        <th class="text-center">
            EMAIL
        </th>
        <th class="text-center">
            USUARIO
        </th>

        <th class="text-center">
            TIPO
        </th>


    </tr>

    </thead>
    <tbody>
    <?php if($users_data != FALSE): ?>


    <?php foreach($users_data as $user): ?>
        <tr id="fila<?php echo $user->idEmpleado;?>">
            <td align="center"><?php echo $user->nombresEmpleado; ?></td>
            <td align="center"><?php echo $user->telefonoEmpleado; ?></td>
            <td align="center"><?php echo $user->emailEmpleado;?></td>
            <td align="center"><?php echo $user->username; ?></td>
            <td align="center"><?php echo $user->tipoEmpleado;?></td>
            <td align="center"><a  title="Borrar" ><i id="btnEliminarEmpleadoTlb" class="fa fa-times fa-3x red-text" data-id="<?php echo $user->idEmpleado; ?>" aria-hidden="true"></i></a></td>
            <td align="center"> <a data-toggle="modal" data-target="#mEditarEmpleado" title="Editar" href="" ><i data-id="<?php echo $user->idEmpleado;?>" id="btnEditarEmpleadoTbl" class="fa fa-edit fa-3x " aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Empleados</p>

<?php endif; ?>

