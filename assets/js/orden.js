/**
 * Created by DELEON on 01-Nov-17.
 */

var baseurl = 'https://ordenes-app.herokuapp.com/';

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
                $("button#cBar").remove()
                $("button#Cocina").remove()

                if (categoria === "Bar") {
                    $("button#cCocina").remove();
                }
                if (categoria === "Cocina") {
                    $("button#c" + categoria).remove();
                }

                $.post(baseurl + 'Products/obtener_productos_categoria/' + id, function (data) {

                    var result = JSON.parse(data);

                    $.each(result, function (i, val) {

                        var content = "";
                        content += '<button type="button" class="producto btn btn-yellow btn-lg btn-block" data-id=' + val.idProducto + ' data-nombre=' + val.producto + ' data-precio=' + val.precioProducto + ' id=c' + categoria + '>' + val.producto + '</button>';

                        $("#contenedor_productos").append(content);
                    });
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

            if (estadoProducto === 0) {

                var content = "";
                content += '<b><p class="alimento' + idalimento + ' text-center">' + nombrealimento + '</p></b>';
                content += '<b><p class="alimento' + idalimento + ' text-left">Precio:  Q' + precio + '</p></b>';
                $("#contenedor_des_producto").append(content);//agrega el producto al apartado descripcion

                $.post(baseurl + 'DetalleProducto/obtener_detalle/' + idalimento, function (data) {

                    var result = JSON.parse(data);

                    if (result) {
                        $.each(result, function (i, val) {

                            var content_ingrediente = "";
                            content_ingrediente += '<li class="alimento' + idalimento + ' text-left">' + val.ingrediente + '</li>';

                            $("#contenedor_des_producto").append(content_ingrediente);
                            //suma el precio de cada producto al total
                        });
                    } else {
                        var content_ingrediente = "";
                        content_ingrediente += '<p class="alimento' + idalimento + '">No contiene descripción</p>';
                        $("#contenedor_des_producto").append(content_ingrediente);
                    }

                });

                var content_boton = "";
                content_boton += '<button type="button" class="btn btn-success btn-lg btn-block btn-agregar alimento' + idalimento + '" data-id="' + idalimento + '" data-nombre="' + nombrealimento + '" data-precio="' + precio + '">Agregar</button>';
                content_boton += '<button type="button" class="btn btn-danger btn-lg btn-block btn-quitar alimento' + idalimento + '" data-id="' + idalimento + '" data-precio="' + precio + '">Quitar</button>';

                $("#contenedor_boton").append(content_boton);//agrega el producto al apartado descripcion

                estadoProducto = 1;
            } else {
                swal("Producto NO Agregado", "Debes agregar el producto seleccionado", "error")
            }

        });
        //FIN DE LA FUNCION
        //==================================================================================================================

        //FUNCION  DE AGREGAR APARTADO DE DESCRIPCION
        $(document).on("click", ".btn-agregar", function (e) {

            var idproducto = $(this).data("id");
            var nombreproducto = $(this).data("nombre");
            var precio = $(this).data("precio");

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
                        content += '<tr id="fila' + idproducto + '">';
                        content += '<td>' + contador + '</td>';
                        content += '<td>' + nombreproducto + '</td>';
                        content += '<td class="text-center" style="width: 5%">';
                        content += '<a href="" data-nombre="' + nombreproducto + '" data-id="' + idproducto + '" data-precio="' + precio + '" class="btnEliminar"><i class="fa fa-close"></i></a>';
                        content += '</td>';
                        content += ' </tr>';

                        $("#tblRegistros").append(content);

                        console.log(producto);
                        //va agregando al array cada producto
                        producto.lista.push({
                            "idProducto": idproducto
                        });


                        //cambia el estado del producto y lo quita del apartado de descripcion
                        $(".alimento" + idproducto).remove();
                        estadoProducto = 0;
                        swal("Agregado!", "El producto ha sido agregado correctamente.", "success");
                    }
                });
        });
        //FIN DE LA FUNCION DEL BOTON agregar
        //==================================================================================================================

        //FUNCION  DE AGREGAR APARTADO DE DESCRIPCION
        $(document).on("click", ".btn-quitar", function (e) {
            var idproducto = $(this).data("id");
            $(".alimento" + idproducto).remove();
            estadoProducto = 0;
        });
        //FIN DE LA FUNCION DEL BOTON AGREGAR
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
        //==================================================================================================================


        //Busqueda del mesero=========================================================================================
        //hacemos focus al campo de búsqueda
        $("#mesero").focus();
        //comprobamos si se pulsa una tecla
        $("#mesero").keyup(function (e) {
            var contenido = "";
            contenido += '<ul class="list-group" id="meseros"></ul>';
            $("#cargamesero").append(contenido);

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

        $(document).on("click", ".cargarMesero", function (e) {
            e.preventDefault();
            //capturamos el id del mesero
            var idMesero = $(this).data("id");
            //capturamos el nombre del mesero
            var nombreMesero = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idMeseroActual = idMesero;
            //asignamos a la variable global el valor de la variable local
            nombreMeseroActual = nombreMesero;
            //al input tipo text le colocamos el valor de la variable local
            $("#mesero").val(nombreMesero);
            $("#meseros").remove();

        });
        //Fin de la busqueda del mesero====================================================================================


        //Busqueda del mesa=========================================================================================
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

    }
});



