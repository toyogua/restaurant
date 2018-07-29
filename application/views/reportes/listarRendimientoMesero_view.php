

<h2 align="center">REPORTES MESEROS <?php print_r( $titulo .' '.$fInicial .'  '. $fFinal  ); ?> </h2>
<hr>

<table id="myTable" class="table table-bordered table-striped">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            NOMBRE
        </th>

        <th class="text-center">
            CANTIDAD DE ORDENES
        </th>

        <th class="text-center">
            MONTO VENDIDO
        </th>


    </tr>

    </thead>
    <tbody>
    <?php if(isset($meseros)): ?>
    <?php foreach($meseros as $mesero): ?>
        <tr id="fila<?php echo $mesero->idempleado; ?>" >
            <td align="center"><?php echo $mesero->nombres . ' ' . $mesero->apellidos ; ?></td>
            <td align="center"><?php echo $mesero->ordenes; ?></td>
            <td align="center"><?php echo moneda($mesero->montos); ?></td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger text-center">No se encontraron Resultados</p>

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

