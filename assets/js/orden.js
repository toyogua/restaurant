
//Variables para el mesero
var idMeseroActual = 0;
var nombreMeseroActual = "";

var idMesaActual = 0;
var noMesaActual = "";
var aliasMesa = "";

var estadoProducto = 0;
var contador = 0;

var producto = {
    lista: []
};

var orden = {
    lista: []
};

var nombrecategoria;
var idcategoria;

//variables para paginar
var porpagina = 4;
var desde = 0;
var totalresultados = 0;
var totalpaginas = 0;
var paginaactual =0;


var fecha = new Date;
var hoy = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
var hora = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
var total = 0.00;

respuesta = false;

$(document).ready(function() {
// Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    //$('.mesa').tooltip('show');

    if( window.location.href === baseurl + 'orders'){
        $('#mCapturaMeseroMesa').modal('show');
    }

    //validamos que el empleado haya seleccionado mesa y mesero antes de eliminar el modal de entrada
    $("#btnEntrarEmpleado").click(function () {
        if (idMesaActual == 0 || idMeseroActual == 0) {
            swal("No Identificado!", "Selecciona la mesa y mesero, para continuar con la orden", "error");
             return false;
        }
        $('#btnEntrarEmpleado').attr('data-dismiss', "modal");

    });

    //APLICAMOS EL EFECTO TOGGLE PARA ESCONDER EL DIV DE LAS CATEGORIAS BEBIDA
    $( "#contenedorBebida" ).toggle( "blind", 1000 );
    $( "#contenedorComida" ).toggle( "blind", 1000 );


    var content = "";
    content += '<b><p class="btn-danger text-center text-total">Total: Q' + total + '</p></b>';

    $("#contenedor_total").append(content);

    var content = "";
    content += '<button style="cursor: pointer;" type="button" class="btn btn-success btn-lg btn-block">Ordenar </button>';

    $("#btn_ordenar").append(content);


    //FUNCION DEL CLICK SOBRE CADA BOTON DE CATEGORIAS
    $(document).on("click", ".btnCategorias", function (e) {

        desde = 0;

        if (idMesaActual == 0 || idMeseroActual == 0) {
            swal("No Identificado!", "Selecciona la mesa y mesero, para continuar con la orden", "error")
        } else {
            e.preventDefault();

            var id = $(this).data("id");
            idcategoria = id;
            var categoria = $(this).data('categoria');
            nombrecategoria = categoria;

            $("div#cBar").remove();
            $("div#cCocina").remove();
            $("#contenedor_productos").empty();

            if (categoria === "Bar") {
                $("div#cCocina").remove();
            }
            if (categoria === "Cocina") {
                $("div#cBar").remove();
            }
            paginaactual = 1;
            $.post(baseurl + 'Products/obtener_productos_categoria/',  {id: id, porpagina:porpagina, desde:0}, function (data) {

                console.log("pagina actual "+paginaactual);

                if (data){
                    $.post(baseurl + 'Products/getCountProducts/', {id: id}, function (data2) {

                        calcularpaginas(data2);

                    });
                }

                var result = JSON.parse(data);
                var content = "";
                content += '<div class="row">';
                $.each(result, function (i, val) {

                    content += '<div class="card col-lg-3 view overlay hm-zoom animated wobble" id=c' + categoria + '>';
                    content += '<div class="view overlay hm-white-slight">';
                    content += '<img data-id=' + val.idProducto + ' data-nombre=' + val.producto + ' data-precio=' + val.precioProducto + ' id=c' + categoria + ' style="padding-top: 5px; cursor:pointer; height: 80px; width: 80px;" src="' + val.imagen + '" class="img-fluid producto" alt="">';
                    content += '</div>';
                    content += '<div class="card-body">';
                    content += '<h6 class="card-title"><strong>' + val.producto + '</strong></h6>';
                    content += '<p> ' + val.descripcionProducto + '</p>';
                    content += '<label>Q ' + val.precioProducto + '</label>';
                    content += '<div style="padding-bottom: 5px;" class="md-form form-group">';
                    content += '<input placeholder="Cantidad" type="number" id="p' + val.idProducto + '" class="form-control cantidad">';
                    content += '</div>';
                    content += '<div>';
                    //content += '<label><i style="cursor: pointer;" class="fa fa-plus">Notas</i></label>';
                    content += '<input id=nota'+ val.idProducto +' type="text" class="notas" placeholder="Notas">';
                    content += '</div>';
                    content += '</div>';
                    content += '</div>';
                });
                content += '</div>';
                $("#contenedor_productos").append(content);

            });

        }

    });   //FIN FUNCION DEL CLICK SOBRE CADA BOTON DE CATEGORIAS

    function calcularpaginas(data2) {

        totalresultados = data2;
        console.log("total datos "+totalresultados);
        totalpaginas = Math.trunc(totalresultados / porpagina);
        totalpaginas = totalpaginas + 1;
        console.log("total paginas "+totalpaginas);
    }

    $("#opanterior").click( function () {
        $("div#cBar").remove();
        $("div#cCocina").remove();
        $("#contenedor_productos").empty();
        if(desde === 0){
            desde = 0;
            console.log("desde"+desde);

        }else{

            desde = desde - 4;

            console.log("pagina actual"+paginaactual);
            console.log("desde"+desde);
            $("div#cBar").remove();
            $("div#cCocina").remove();
        }
        if(paginaactual > 1){
            paginaactual = paginaactual - 1;
        }else {
            paginaactual = 1;
        }

        $.post(baseurl + 'Products/obtener_productos_categoria/',  {id: idcategoria, porpagina:porpagina, desde:desde}, function (data) {

            renderProductos( nombrecategoria, data);
        });
    });//opanterior

    $("#opsiguiente").click( function () {
        $("div#cBar").remove();
        $("div#cCocina").remove();
        $("#contenedor_productos").empty();

        if(totalpaginas === 1){
            desde = 0;
            console.log("desde",desde);
        }else
        if (paginaactual <totalpaginas){
            paginaactual = paginaactual + 1;
            desde =  desde + 4;
            console.log("desde"+desde);
            console.log("pagina actual"+paginaactual)
        }

        $.post(baseurl + 'Products/obtener_productos_categoria/',  {id: idcategoria, porpagina:porpagina, desde:desde}, function (data) {

            renderProductos( nombrecategoria, data);

        });

    });//fin opsiguiente

    function renderProductos( categoria, data) {

        var result = JSON.parse(data);
        var content = "";
        content += '<div class="row">';
        $.each(result, function (i, val) {

            content += '<div class="card col-lg-3 view overlay hm-zoom animated wobble" id=c' + categoria + '>';
            content += '<div class="view overlay hm-white-slight">';
            content += '<img data-id=' + val.idProducto + ' data-nombre=' + val.producto + ' data-precio=' + val.precioProducto + ' id=c' + categoria + ' style="padding-top: 5px; cursor:pointer; height: 80px; width: 80px;" src="'+ val.imagen +'" class="img-fluid producto" alt="">';
            content += '</div>';
            content += '<div class="card-body">';
            content += '<h6 class="card-title"><strong>'+val.producto+'</strong></h6>';
            content += '<p> ' + val.descripcionProducto + '</p>';
            content += '<label>Q '+ val.precioProducto +'</label>';
            content += '<div style="padding-bottom: 5px;" class="md-form form-group">';
            content += '<input placeholder="Cantidad" type="number" id="p'+ val.idProducto +'" class="form-control cantidad">';
            content += '</div>';
            content += '<div>';
            //content += '<label><i data-toggle="modal" data-target="#modalNotasOrden" style="cursor: pointer;" class="fa fa-plus">Notas</i></label>';
            content += '<input id=nota'+ val.idProducto +' type="text" class="notas" placeholder="Notas">';
            content += '</div>';
            content += '</div>';
            content += '</div>';
        });
        content += '</div>';
        $("#contenedor_productos").append(content);

    }//fin renderproducto

    //cuando da click en cada producto
    $(document).on("click", ".producto", function () {

        var subtotal = 0;

        var idalimento = $(this).data("id");
        var nombrealimento = $(this).data("nombre");
        var precio = $(this).data("precio");

        var cantidad = $("#p"+idalimento).val();
        //var notas = $(".notas").val();
        var notas = $("#nota"+idalimento).val();

        subtotal = precio * cantidad;

        console.log(subtotal);

        if (cantidad == 0){
            swal("Error!", "El campo cantidad no puede estar vacio", "error")
            return false;
        }
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

                    total = (parseFloat(subtotal) + parseFloat(total));

                    $(".cantidad").val("");
                    $(".notas").val("");

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
                    content += '<a href="" data-subtotal="'+ subtotal +'" data-nombre="' + nombrealimento + '" data-id="' + idalimento + '" data-precio="' + precio + '" class="btnEliminar"><i class="fa fa-close"></i></a>';
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
        var id = $(this).data("id");
        var precio = $(this).data("precio");
        var subtotal = $(this).data("subtotal");


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
                    total = (parseFloat(total) - parseFloat(subtotal));

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
                        "idMesa":       idMesaActual,
                        "totalOrden":   total,
                        "idEmpleado":   idMeseroActual,
                        "estadoOrden":  0,
                        "fechaOrden":   hoy,
                        "horaOrden":    hora,
                        "aliasMesa":    aliasMesa

                    };

                    $("#tblRegistros").empty();
                    $("#contenedor_total").empty();
                    total = 0;

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

        $("#divInformaMeseroSeleccionado").text('Seleccionó: '+ nombreMesero +'');

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

        var alias = $(".txtAliasMesa").val();
        aliasMesa = alias;

        $("#divInformaMesaSeleccionada").text('Seleccionó: '+ noMesa +'');

        //asignamos a la variable global el valor de la variable local
        idMesaActual = idMesa;
        //asignamos a la variable global el valor de la variable local
        noMesaActual = noMesa;

        console.log(idMesaActual);

    });
    //Fin de la asginacion de mesero================================================================================

    $(document).on("click", "#btnBebida", function () {

        $( "#contenedorBebida" ).toggle( "blind", 1000 );

    });

    $(document).on("click", "#btnComida", function () {

        $( "#contenedorComida" ).toggle( "blind", 1000 );

    });


});


