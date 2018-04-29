var permisos = {
    listos: []
};
$(document).ready(function () {

    $(".acctodos").change(function () {

        let idmodulo = $(this).data("id");

        $("input:checkbox."+idmodulo).prop('checked', $(this).prop("checked"));
    });

    $("#btnAsignarPermisos").click( function () {
        let idempleado = $("#idempleado").val();

        $("input:checkbox:checked").each(
            function() {
                if ($(this).data("modulo") !== undefined)
                permisos.listos.push({
                    "id_empleado":  idempleado,
                    "id_modulo":     $(this).data("modulo"),
                    "accion":       $(this).val()

                });
            }
        );

        let permisosJSON= JSON.stringify(permisos.listos);

        $.ajax({
            type: "POST",
            url: baseurl + 'Permisos/insertarPermisos',
            dataType: 'json',
            data: {permisos: permisosJSON},
            success: function (res) {
                if (res) {

                    //alertify.success('Venta Procesada');
                }

            }
        });
        setInterval(function() {
            //cache_clear()
        }, 1000);

        console.log(permisosJSON);

    });
});