/**
 * Created by DELEON on 01-Nov-17.
 */

var baseurl = 'http://localhost/restaurant/';

//Variables para el mesero
var idMeseroActual = 0;
var nombreMeseroActual = "";

var idMesaActual = 0;
var noMesaActual = "";
var estadoProducto = 0;
var contador = 0;

var producto = {
    lista: []
};

var orden = {
    lista: []
};

var fecha = new Date;
var hoy = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
var hora = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
var total = 0.00;

respuesta = false;

$(document).ready(function() {
    if( window.location.href === baseurl + 'orders') {

        var content = "";
        content += '<b><p class="btn-danger text-center text-total">Total: Q' + total + '</p></b>';

        $("#contenedor_total").append(content);

        var content = "";
        content += '<button type="button" class="btn btn-success btn-lg btn-block">Ordenar </button>';

        $("#btn_ordenar").append(content);


        //FUNCION DEL CLICK SOBRE CADA BOTON DE CATEGORIAS
        $(document).on("click", ".btnCategorias", function (e) {


            if (idMesaActual == 0 || idMeseroActual == 0) {
                swal("No Identificado!", "Selecciona la mesa y mesero, para continuar con la orden", "error")
            } else {
                e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

                //Cuando se da click sobre otra categoria oculta la actual
                var id = $(this).data("id");
                var categoria = $(this).data('categoria');
                console.log(categoria);
                $("div#cBar").remove();
                $("div#Cocina").remove();

                if (categoria === "Bar") {
                    $("div#cCocina").remove();
                }
                if (categoria === "Cocina") {
                    $("div#c" + categoria).remove();
                }

                $.post(baseurl + 'Products/obtener_productos_categoria/' + id, function (data) {

                    var result = JSON.parse(data);
                    var content = "";
                    content += '<div class="row">';
                    $.each(result, function (i, val) {

                        content += '<div class="card col-lg-3" id=c' + categoria + '>';
                        content += '<div class="view overlay hm-white-slight">';
                        content += '<img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%287%29.jpg" class="img-fluid" alt="">';
                        content += '</div>';
                        content += '<div class="card-body">';
                        content += '<h4 class="card-title"><strong>'+val.producto+'</strong></h4>';
                        content += '<div class="md-form form-group">';
                        content += '<input type="text" id="form91" class="form-control cantidad">';
                        content += '<label for="form91">Cantidad</label>';
                        content += '</div>';
                        content += '<div class="md-form">';
                        content += '<textarea type="text" id="form7" class="md-textarea notas"></textarea>';
                        content += '<label for="form7">Notas</label>';
                        content += '</div>';
                        content += '<button type="button" class="producto btn btn-success" data-id=' + val.idProducto + ' data-nombre=' + val.producto + ' data-precio=' + val.precioProducto + ' id=c' + categoria + '>Agregar</button>';
                        //content += '<a href="#" class="btn btn-primary">Button</a>';
                        content += '</div>';
                        content += '</div>';
                        //content += '<img src="data:image/jpg;base64,'+atob(val.imagen)+' "/>';
                    });
                    content += '</div>';
                    $("#contenedor_productos").append(content);
                });
            }
        });
        //FIN FUNCION DEL CLICK SOBRE CADA BOTON DE CATEGORIAS
        //=================================================================================================================

        //cuando da click en cada producto
        $(document).on("click", ".producto", function (e) {

            var idalimento = $(this).data("id");
            var nombrealimento = $(this).data("nombre");
            var precio = $(this).data("precio");

            var cantidad = $(".cantidad").val();
            var notas = $(".notas").val();

            $("p.text-total").remove();

            swal({
                    title: "Estas seguro?",
                    text: "de querer agregar este producto",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, agregalo!",
                    cancelButtonText: "Cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function (isConfirm) {

                    if (isConfirm) {

                        total = (parseFloat(precio) + parseFloat(total));

                        var content = "";
                        content += '<b><p class="btn-danger text-center text-total">Total: Q' + total + '</p></b>';

                        $("#contenedor_total").append(content);

                        contador = contador + 1;
                        var content = "";
                        content += '<tr id="fila' + idalimento + '">';
                        content += '<td>' + cantidad + '</td>';
                        content += '<td>' + nombrealimento + '</td>';
                        content += '<td>' + notas + '</td>';
                        content += '<td class="text-center" style="width: 5%">';
                        content += '<a href="" data-nombre="' + nombrealimento + '" data-id="' + idalimento + '" data-precio="' + precio + '" class="btnEliminar"><i class="fa fa-close"></i></a>';
                        content += '</td>';
                        content += ' </tr>';

                        $("#tblRegistros").append(content);

                        console.log(producto);
                        //va agregando al array cada producto
                        producto.lista.push({
                            "idProducto"        : idalimento,
                            "cantDetalleOrden"  : cantidad,
                            "notaDetalleOrden"  : notas
                        });


                        //cambia el estado del producto y lo quita del apartado de descripcion
                        //$(".alimento" + idalimento).remove();
                        //estadoProducto = 0;
                        swal("Agregado!", "El producto ha sido agregado correctamente.", "success");
                    }
                });
        });
        //FIN DE LA FUNCION
        //==================================================================================================================


        $("body").on("click", ".btnEliminar", function (e) {
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre = $(this).data("nombre");
            var id = $(this).data('id');
            var precio = $(this).data('precio');

            $("p.text-total").remove();

            //codigo de la alerta
            swal({
                    title: "Estas seguro?",
                    text: "de querer borrar" + nombre,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si, borralo!",
                    cancelButtonText: "Cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function (isConfirm) {

                    if (isConfirm) {
                        borrarRegistro(id);
                        total = (parseFloat(total) - parseFloat(precio));

                        var content = "";
                        content += '<b><p class="btn-danger text-center text-total">Total: Q' + total + '</p></b>';

                        $("#contenedor_total").append(content);

                    }
                });

        });

        function borrarRegistro(id) {
            //cuando estamos seguros que lo que queremos borrar

            //borra el elemento del array
            producto.lista.splice({"idProducto": id}, 1);

            //quita la fila de la tabla del apartado orden
            $("#fila" + id).remove();
            swal("Borrado!", "El registro ha sido eliminado correctamente.", "success");
        }

        //FUNCION DE ORDENAR, ULTIMO BLOQUE DE LA PANTALLA
        $(document).on("click", "#btn_ordenar", function (e) {

            //codigo de la alerta
            swal({
                    title: "Estas seguro?",
                    text: "de procesar la orden",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si!",
                    cancelButtonText: "Cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function (isConfirm) {

                    if (isConfirm) {
                        //Crea la orden
                        orden.lista = {
                            "idMesa": idMesaActual,
                            "totalOrden": total,
                            "idEmpleado": idMeseroActual,
                            "estadoOrden": 0,
                            "fechaOrden": hoy,
                            "horaOrden": hora

                        };

                        var ordenJSON = JSON.stringify(orden.lista);
                        var detalleJSON = JSON.stringify(producto.lista);

                        // Realizamos la petición al servidor
                        $.post(baseurl + 'Orders/insertarOrden', {orden: ordenJSON, detalle: detalleJSON},
                            function (respuesta) {
                                console.log(respuesta);
                                swal("Procesando!", "La orden sido creada correctamente.", "success");
                            }).error(
                            function () {
                                console.log('Error al ejecutar la petición');
                            });
                    }
                    window.location = baseurl + 'orders';
                });

        });
        //FIN DE LA FUNCION ORDENAR
        //==============================================================================================================

        //Busqueda del mesa=============================================================================================
        //hacemos focus al campo de búsqueda
        $("#mesa").focus();
        //comprobamos si se pulsa una tecla
        $("#mesa").keyup(function (e) {

            var contenido = "";
            contenido += '<ul class="list-group" id="mesas"></ul>';
            $("#cargamesas").append(contenido);

            var consulta;
            //obtenemos el texto introducido en el campo de búsqueda
            consulta = $("#mesa").val();
            //hace la búsqueda
            if (consulta != "") {
                $.post(baseurl + 'Mesas/buscarMesas', {nombre: consulta}, function (mensaje) {
                    if (mensaje != '') {
                        $("#mesas").show();
                        $("#mesas").html(mensaje);
                        //console.log(mensaje);
                    } else {
                        $("#mesas").html('');
                    }
                    ;
                });
            }
        });

        $(document).on("click", ".cargarMesa", function (e) {
            e.preventDefault();
            //capturamos el id del mesero
            var idMesa = $(this).data("id");
            //capturamos el nombre del mesero
            var noMesa = $(this).data("nombre");

            //$.post(baseurl + 'Mesas/getMesa/' + idMesa, function(respuesta) {
            //    if(respuesta === null){
            //        console.log(respuesta);
            //        swal({
            //                title: "Mesa Ocupada?",
            //                text: "desea agregar más ordenes a la mesa?",
            //                type: "warning",
            //                showCancelButton: true,
            //                confirmButtonColor: "#DD6B55",
            //                confirmButtonText: "Si!",
            //                cancelButtonText: "Cancelar!",
            //                closeOnConfirm: false,
            //                closeOnCancel: true
            //            },
            //            function(isConfirm){
            //
            //                if (isConfirm) {
            //                    swal("Ocupada!", "La mesa ha sido seleccionada correctamente.", "success");
            //                    //asignamos a la variable global el valor de la variable local
            //                    idMesaActual = idMesa;
            //                    //asignamos a la variable global el valor de la variable local
            //                    noMesaActual = noMesa;
            //                    //al input tipo text le colocamos el valor de la variable local
            //                    $("#mesa").val(noMesa);
            //                    $("#mesas").remove();
            //                }
            //            });
            //    }
            //});
            //asignamos a la variable global el valor de la variable local
            idMesaActual = idMesa;
            //asignamos a la variable global el valor de la variable local
            noMesaActual = noMesa;
            //al input tipo text le colocamos el valor de la variable local
            $("#mesa").val(noMesa);
            $("#mesas").remove();

        });
        //Fin de la busqueda del mesas====================================================================================



        //Asigna el mesero seleccionado a la orden
        $(document).on("click", ".mesero", function (e) {
            e.preventDefault();
            //capturamos el id del mesero
            var idMesero = $(this).data("id");
            var nombreMesero = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idMeseroActual = idMesero;
            //asignamos a la variable global el valor de la variable local
            nombreMeseroActual = nombreMesero;

            console.log(idMeseroActual);

        });
        //Fin de la asginacion de mesero================================================================================

        //Asigna el mesa seleccionado a la orden
        $(document).on("click", ".mesa", function (e) {
            e.preventDefault();
            //capturamos el id del mesero
            var idMesa = $(this).data("id");
            var noMesa = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idMesaActual = idMesa;
            //asignamos a la variable global el valor de la variable local
            noMesaActual = noMesa;

            console.log(idMesaActual);

        });
        //Fin de la asginacion de mesero================================================================================
    }
});



