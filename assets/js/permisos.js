var permisos = {
    listos: []
};

var aborrar = {
    listos: []
};

$(document).ready(function () {



    $(".acctodos").change(function () {

        var idmodulo = $(this).data("id");

        $("input:checkbox."+idmodulo).prop('checked', $(this).prop("checked"));
    });

    $(document).on("change", "input:checkbox", function () {

        var idempleado = $("#idempleado").val();

        if( !$(this).is(':checked') ) {
           aborrar.listos.push({
               "id_empleado": idempleado,
               "id_modulo": $(this).data("modulo"),
               "accion": $(this).val()
               });
        }
    });

    $("#btnAsignarPermisos").click( function () {
        var idempleado = $("#idempleado").val();


        alertify.confirm('Estás seguro?', 'De querer realizar esta acción?',

            function(){

                    $("input:checkbox:checked").each(
                        function () {
                            if ($(this).data("modulo") !== undefined)
                                permisos.listos.push({
                                    "id_empleado": idempleado,
                                    "id_modulo": $(this).data("modulo"),
                                    "accion": $(this).val()

                                });
                        }
                    );



                var borrarJSON      = JSON.stringify( aborrar.listos );
                var permisosJSON    = JSON.stringify( permisos.listos );

                $.ajax({
                    type: "POST",
                    url: baseurl + 'Permisos/insertarPermisos',
                    dataType: 'json',
                    data: {permisos: permisosJSON, borrar: borrarJSON},
                    success: function (res) {
                        if (res) {

                            alertify.success('Permisos Actualizados!');
                        }

                    }
                });
                setInterval(function() {
                    recargar();
                }, 1000);

            },
            function(){
                alertify.error('Cancelado')
            });

    });

});

function recargar() {
    window.location.href = baseurl+"Permisos/";
}