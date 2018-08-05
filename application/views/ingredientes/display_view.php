<h2 align="center">INGREDIENTES </h2>
<hr>

<!--<div class="row">-->
    <div class="col-md-2">
        <!-- Button trigger modal -->
        <button style="cursor: pointer;"  type="button" class="btn btn-success btnNuevoIngrediente" data-toggle="modal" data-target="#modaIngrediente">
            <i class="fa fa-plus"></i>Nuevo Ingrediente
        </button>
    </div>
<!--    <div>-->
<!--        --><?php //$this->load->view('layouts/paginacion_view'); ?>
<!--    </div>-->
<!---->
<!--        --><?php //$this->load->view('layouts/form_view'); ?>
<!---->
<!--</div>-->

<div class="modal fade  myModal" id="modaIngrediente" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="ingredienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="ingredienteModalLabel">Nuevo ingrediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="contenedorIngredienteRegistro">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" style="cursor: pointer;" class="btn btn-danger" id="btnCancelarRegistroIngreddiente" data-dismiss="modal">Cancelar</button>
                <button type="button" style="cursor: pointer;" class="btn btn-success" id="btnRegistrarIngrediente" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false"  id="modalIngrediente" tabindex="-1" role="dialog" aria-labelledby="ingredienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="ingredienteModalLabel">Editar Ingrediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="contenedor_editar_ingrediente"></div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarIngrediente" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnEditIngrediente" data-dismiss="modal">Editar</button>
            </div>
        </div>
    </div>
</div>



<?php if($ingredientes_data!=FALSE): ?>
 <?php $contador = 0; ?>

<table id="myTable" class="table table-bordered table-striped ">

    <!--Table head-->
    <thead>
    <tr>
        <th scope="row"><b>#</b></th>
        <th class="th-lg"><b>Ingrediente</b></th>
        <th class="th-lg"><b>Descripción</b></th>
        <th class="th-lg"><b>Fecha de ingreso</b></th>
        <th class="th-lg"><b>Costo</b></th>
        <th class="th-lg"><b>Existencia</b></th>
        <th class="th-lg"><b>Medida</b></th>
        <th class="th-lg"><b>Tipo Inventario</b></th>
        <th class="th-lg"><b>Eliminar</b></th>
        <th class="th-lg"><b>Editar</b></th>
    </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
    <?php foreach($ingredientes_data as $ingrediente): ?>
        <?php $contador = $contador + 1; ?>
        <tr id="fila<?php echo $ingrediente->idIngrediente;?>">
            <?php  echo "<td>" . $contador ."</td>"; ?>
            <?php  echo "<td style='width: 25%;'>" . $ingrediente->ingrediente ."</td>"; ?>
            <?php  echo "<td style='width: 10%;'>" . $ingrediente->descripcionIngrediente ."</td>"; ?>
            <?php  echo "<td style='width: 15%' align='center'>" . $ingrediente->fechaIngreso ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='center'>Q " . $ingrediente->costoIngrediente ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='center'>" . $ingrediente->cantIngrediente ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='center'>" . $ingrediente->medida ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='center'>" . $ingrediente->tipo ."</td>"; ?>

            <td align="center" style='width: 5%'><a class="btnEliminarIngrediente" title="Borrar" href="" data-nombre="<?php echo $ingrediente->ingrediente;?>" data-id="<?php echo $ingrediente->idIngrediente;?>"><i class="fa fa-times fa-3x red-text" aria-hidden="true"></i></a></td>
            <td align="center" style='width: 5%'><a data-toggle="modal" data-target="#modalIngrediente" class="btnEditarIngrediente" title="Editar" href="" data-id="<?php echo $ingrediente->idIngrediente;?>"><i class="fa fa-edit fa-3x" aria-hidden="true"></i></a></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table><br>

<!--</div>-->
<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Ingredientes</p>
<?php endif; ?>


<script>
    $( function () {
        $("select.form-control").removeClass("form-control-sm");
        $("select.form-control").css("cursor", "pointer" );
        $("input.form-control").removeClass("form-control form-control-sm");
    });

    $('#myTable').dataTable( {
        //"dom": '<"row"<"col-md-3" f > <"col-md-3" p > <"col-md-1" l > <"col-md-3" i > > rt <"bottom"i><"clear">',
        "dom": '<"row" <"col-md-3" f > <"col-md-3" p > <"col-md-2 cantidad" l > <"col-md-3" i >> rt <"clear">',
        language: {
            processing:     "Solicitud en curso...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ elementos",
            info:           "Mostrando elementos _START_ al _END_ de _TOTAL_  elementos",
            infoEmpty:      "Ningún elemento encontrado",
            infoFiltered:   "(0 filtrados de _MAX_ elementos en total)",
            infoPostFix:    "",
            loadingRecords: "Datos cargandose...",
            zeroRecords:    "No se encontró ningún resultado",
            emptyTable:     "Sin datos para mostrar",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    } );
</script>




