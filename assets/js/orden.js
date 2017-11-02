/**
 * Created by DELEON on 01-Nov-17.
 */

var baseurl = 'http://localhost/restaurant/';

//Variables para el mesero
var idMeseroActual = 0;
var nombreMeseroActual = "";
$(document).ready(function() {

        //aca no comprendo que esta tratando de hacer
        //seria mejor en lugar de "body" poner la clase del elemento que esta utlizando
        //por ejemplo  $(".claseelemento").on("click", ".btnCategorias", function (e) {
        //y lo optimo para este caso seria $(".bntCategoris").click( function(){
        //todo lo demas queda igual

        $("body").on("click", ".btnCategorias", function (e) {
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link


            //nombre tomado del data-nombre
            var id = $(this).data("id");
            var categoria = $(this).data('categoria');
            console.log(id);
            console.log(categoria);

            $.post(baseurl + 'Products/obtener_productos_categoria/' + id, function (data) {

                var result = JSON.parse(data);

                console.log(result);

                $.each(result, function (i, val) {

                    var content = "";
                    content += '<button type="button" class="btn btn-yellow btn-lg btn-block">' + val.producto + '</button>';

                    $("#contenedor_productos").append(content);

                });
            });

        });


        //realiazar busqueda de paciente para reporte
        //hacemos focus al campo de búsqueda
        $("#mesero").focus();
        //comprobamos si se pulsa una tecla
        $("#mesero").keyup(function (e) {
            var contenido = "";
            contenido += '<ul class="list-group" id="meseros"></ul>';
            $("#cargabusqueda").append(contenido);

            var consulta;
            //obtenemos el texto introducido en el campo de búsqueda
            consulta = $("#mesero").val();
            //hace la búsqueda
            if (consulta != "") {
                $.post(baseurl + 'Empleados/buscarMesero', {nombre: consulta}, function (mensaje) {
                    if (mensaje != '') {
                        $("#meseros").show();
                        $("#meseros").html(mensaje);
                        //console.log(mensaje);
                    } else {
                        $("#meseros").html('');
                    }
                    ;
                });
            }
        });

        //cuando se da click sobre el nombre de algun paciente determinado
        $(".cargarMesero").live('click', function (e) {
            e.preventDefault();
            //capturamos el id del paciente
            var idMesero = $(this).data("id");
            //capturamos el nombre del paciente
            var nombreMesero = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idMeseroActual = idMesero;
            //asignamos a la variable global el valor de la variable local
            nombreMeseroActual = nombreMesero;
            //al input tipo text le colocamos el valor de la variable
            $("#mesero").val(nombreMesero);
            $("#meseros").remove();

        });

        //siempre que se vaya a dar click sobre un elemtento creado dinamicamente en el DOM
        //ulitilizareos esta funcion .on en lugar de .live
        //con atencion a como seteamos el elemento (cargarmesero en este caso)
        $( document ).on( "click", ".cargarmesero", function (e) {
        e.preventDefault()
            //capturamos el id del paciente
            var idMesero = $(this).data("id");
            //capturamos el nombre del paciente
            var nombreMesero = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idMeseroActual = idMesero;
            //asignamos a la variable global el valor de la variable local
            nombreMeseroActual = nombreMesero;
            //al input tipo text le colocamos el valor de la variable
            $("#mesero").val(nombreMesero);
            $("#meseros").remove();



    })


})



