var c;
var m;
$(document).ready(function() {
    $("#iconorefrescar").hide();

    $("#txtbuscador").focus();
    //comprobamos si se pulsa una tecla
    $("#txtbuscador").keyup(function () {

        var contenido = "";
        contenido += '<ul style="position: absolute;" class="list-group" id="obtenidos"></ul>';
        $("#resultados").append(contenido);

        var consulta;
        //obtenemos el texto introducido en el campo de búsqueda
        consulta = $("#txtbuscador").val();

        var campo = $("#txtbuscador").data("campo");
        var tabla = $("#txtbuscador").data("tabla");
        var controlador = $("#txtbuscador").data("controlador");
        var buscador = $("#txtbuscador").data("buscador");
        var metodo =  $("#txtbuscador").data("metodo");

        c = controlador;
        m = metodo;

        //hace la búsqueda
        if (consulta != "") {
            $.post(baseurl + controlador + buscador, {nombre: consulta, campo:campo, tabla:tabla}, function (mensaje) {
                if (mensaje != '') {
                    $("#iconorefrescar").show();
                    $("#obtenidos").show();
                    $("#obtenidos").html(mensaje);
                } else {
                    $("#obtenidos").html('');
                }

            });
        }
    });

    $(document).on("click", ".respuesta", function () {
        var id = $(this).data("id");

            window.location.href = baseurl+c+m+'/'+1+'/'+0+'/' + id;
    });

});