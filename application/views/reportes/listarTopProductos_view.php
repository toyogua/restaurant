

<h2 align="center">REPORTES PRODUCTOS <?php print_r( $titulo .' '.$fInicial .'  '. $fFinal  ); ?> </h2>
<hr>

<table id="myTable" class="table table-bordered table-striped">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            PRODUCTO
        </th>

        <th class="text-center">
            FECHA VENTA
        </th>

        <th class="text-center">
            UNIDADES VENDIDAS
        </th>


    </tr>

    </thead>
    <tbody>
    <?php if(isset($productos)): ?>


    <?php foreach($productos as $producto): ?>
        <tr id="fila<?php echo $producto->idproducto; ?>" >
            <td align="center"><?php echo $producto->producto; ?></td>
            <td align="center"><?php echo date("d/m/Y", strtotime($producto->fechaventa)); ?></td>
            <td align="center"><?php echo $producto->unidades; ?></td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger text-center">No se encontraron Productos</p>

<?php endif; ?>

<script>

    $( function () {
        $("select.form-control").removeClass("form-control-sm");
        $("select.form-control").css("cursor", "pointer" );
        $("input.form-control").removeClass("form-control form-control-sm");
    });

    $('#myTable').dataTable( {
        //"dom": '<"row"<"col-md-3" f > <"col-md-3" p > <"col-md-1" l > <"col-md-3" i > > rt <"bottom"i><"clear">',
        //para los encabezados
        // f = buscar p=pagineo l=mostrar elementos i=cantidad de elementos
        "dom": '<"row" <"col-md-3" f > <"col-md-3" p > <"col-md-2 cantidad" l > <"col-md-3" i >> rt <"clear">',
        //ordenar el numero de columna y el orden
        //"order": [[ 2, "desc"]],
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
        },

        //sin ordenar, toma el orden que devuelva la consulta
        ordering:  false


    } );
</script>

