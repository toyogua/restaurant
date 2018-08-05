

<h2 align="center">REPORTES MOVIMIENTOS CAJA <?php print_r( $titulo .' '.$fInicial .'  '. $fFinal  ); ?> </h2>
<hr>



<?php //if ( $total!= null || $total >0): ?>
<!--    <div class="col-md-4 offset-10">-->
<!--        <label class="btn btn-info">Totales: --><?php //echo moneda($total)?><!--</label>-->
<!--    </div>-->
<?php //endif; ?>
<table id="myTable" class="table table-bordered table-striped">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            INICIO
        </th>

        <th class="text-center">
            FIN
        </th>
        <th class="text-center">
            EMPLEADO
        </th>
        <th class="text-center">
            MONTO INICIO
        </th>
        <th class="text-center">
            MONTO FIN
        </th>

    </tr>

    </thead>
    <tbody>
    <?php if( isset($movimientos)): ?>

    <?php foreach($movimientos as $movimiento): ?>
        <tr id="fila<?php echo $movimiento->idmovimiento; ?>" >
            <td align="center"><?php echo date("d/m/Y H:i:s", strtotime($movimiento->apertura)); ?></td>
            <td align="center"><?php echo date("d/m/Y H:i:s", strtotime($movimiento->cierre)); ?></td>
            <td align="center"><?php echo $movimiento->nombres . ' '.  $movimiento->apellidos; ?></td>
            <td align="center"><?php echo  moneda( $movimiento->montoApertura ); ?></td>
            <td align="center"><?php echo  moneda( $movimiento->montoCierre ); ?></td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Ordenes</p>

<?php endif; ?>

<!--paginacion completa-->
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


