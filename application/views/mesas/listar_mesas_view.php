<h2 align="center">MESAS </h2>
<hr>

<div class="row">
    <div class="col-md-2">
        <!-- Button trigger modal -->
        <button id="btnCrearMesa" style="cursor: pointer;" type="button" class="btn btn-success" data-toggle="modal" data-target="#mCrearMesa">
            <i class="fa fa-plus"></i>Crear Mesa
        </button>
    </div>

    <!-- Small button group -->
    <div class="col-md-2">

            <button style="cursor: pointer;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filtrar
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo base_url(); ?>Mesas/ocupadas">Ocupadas</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>Mesas/listar">Todas</a>

            </div>

    </div>

    <div>
        <?php $this->load->view('layouts/paginacion_view'); ?>
    </div>
    <?php $this->load->view('layouts/form_view'); ?>

</div>



<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mCrearMesa" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4   class="modal-title font-weight-bold" id="productoModalLabel">Nueva Mesa</h4>
            </div>
            <div class="modal-body">
                <div id="divFormularioNuevaMesa">

                </div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarNuevaMesa" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnNuevaMesa" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mEditarMesa" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Editar Mesa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divFormularioEditarMesa"></div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarMesa" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnEditarMesa" data-dismiss="modal">Editar</button>
            </div>
        </div>
    </div>
</div>


<table class="table table-bordered table-striped">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            NO MESA
        </th>

        <th class="text-center">
            UBICACION
        </th>

        <th class="text-center">
            OCUPADA/DESOCUPADA
        </th>

<!--        <th class="text-center">-->
<!--           TOTAL CUENTA-->
<!--        </th>-->



    </tr>

    </thead>
    <tbody>
    <?php if($mesas_data != FALSE): ?>


    <?php foreach($mesas_data as $mesa): ?>
        <tr id="fila<?php echo $mesa->idMesa;?>">
            <td align="center"><?php echo $mesa->noMesa; ?></td>
            <td align="center"><?php echo $mesa->ubicacionMesa; ?></td>
            <td align="center"><?php echo $res = ($mesa->ocupada == 1)? "OCUPADA" : "DESOCUPADA"; ?></td>
<!--            <td align="center">--><?php //echo $res = ($mesa->ocupada == 1)? "Q ".$mesa->totalOrden : 0; ?><!--</td>-->
            <td align="center"><a title="Borrar" ><i id="btnEliminarMesaTbl" data-id="<?php echo $mesa->idMesa;?>"  class="fa fa-times fa-3x red-text" aria-hidden="true"></i></a></td>
            <td align="center"> <a data-toggle="modal" data-target="#mEditarMesa"  title="Editar" href=""><i data-id="<?php echo $mesa->idMesa;?>" id="btnEditarMesaTbl" class="fa fa-edit fa-3x" aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Mesas</p>

<?php endif; ?>



