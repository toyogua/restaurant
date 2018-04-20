<h2 align="center">TIPOS DE EMPLEADOS </h2>
<hr>


<!-- Button trigger modal -->
<button style="cursor: pointer;" id="btnNuevoTipoEmpleado" type="button" class="btn btn-success" data-toggle="modal" data-target="#mNuevoTipoEmpleado">
    <i class="fa fa-plus"></i>Nuevo Tipo
</button>
<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mNuevoTipoEmpleado" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog moda-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4   class="modal-title font-weight-bold" id="productoModalLabel">Nuevo Tipo</h4>
            </div>
            <div class="modal-body">
                <div id="divFormNuevoTipoEmpleado">

                </div>

            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarNuevoTipoEmpleado" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnCrearTipoEmpleado">Crear</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mEditarTipoEmpleado" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold">Editar Tipo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divEditarTipoEmpleado">

                </div>

            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarTipoEmpleado" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnEditarTipoEmpleado">Editar</button>
            </div>
        </div>
    </div>
</div>



<table class="table table-bordered table-striped listadoproductos">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            TIPO
        </th>


    </tr>

    </thead>
    <tbody id="mostralistadoproductos">
    <?php if($data_tipos != FALSE): ?>


    <?php foreach($data_tipos as $tipo): ?>
        <tr id="fila<?php echo $tipo->idTipoEmpleado; ?>">
            <td align="center"><?php echo $tipo->tipoEmpleado; ?></td>

            <td align="center"><a  title="Borrar" ><i id="btnEliminarTipoEmpleadoTbl" class="fa fa-times fa-3x red-text" data-id="<?php echo $tipo->idTipoEmpleado; ?>" aria-hidden="true"></i></a></td>
            <td align="center"> <a data-toggle="modal" data-target="#mEditarTipoEmpleado" title="Editar" href="" ><i data-id="<?php echo $tipo->idTipoEmpleado;?>" id="btnEditarTipoEmpleadoTbl" class="fa fa-edit fa-3x " aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Tipos</p>

<?php endif; ?>

