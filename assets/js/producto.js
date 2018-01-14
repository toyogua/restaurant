/**
 * Created by DELEON on 10-Nov-17.
 */

var baseurl = 'http://localhost/restaurant/';

var producto = {
    lista: []
};

idCategoriaActual = 0;
categoriaActual = "";

var idProducto = 0;

$(document).ready(function() {

    //console.log(hora);
    if( window.location.href === baseurl + 'Products/display'){

        $(document).on("click", ".btnNuevoProducto", function (e) {
            var content = "";
            content += '<form>';
            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" id="producto">';
            content += '<label>Producto</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<textarea type="text" class="md-textarea form-control" id="descripcion"></textarea>';
            content += '<label>Descripción</label>';
            content += '</div>';
            //content += '<div class="row">';
            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" id="costo">';
            content += '<label>Costo</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" id="precio">';
            content += '<label>Precio</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<label>Cantidad</label>';
            content += '<input type="text" class="form-control" id="cantidad">';
            content += '</div>';
            content += '<div class="">';
            content += '<h6>Imagen</h6><br>';
            content += '<input type="file" class="" id="imagen">';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<label>Categoria</label>';
            content += '<input type="text" class="form-control categoria" id="categoria">';
            content += '</div>';
            //content += '</div>';
            content += '</form>';
            $(".contenedorProductoRegistro").append(content);
        });

        $(document).on("click", "#btnCancelarRegistroIngreddiente", function (e) {
            $(".contenedorProductoRegistro").empty();
        });

        $(document).on("click", "#btnRegistrarProducto", function (e) {

            alertify.confirm('Estas seguro?', 'De querer registrar este producto',
                function(){
                    producto.lista={
                        "producto"              : document.getElementById("producto").value,
                        "descripcionProducto"   : document.getElementById("descripcion").value,
                        "costoProducto"         : document.getElementById("costo").value,
                        "precioProducto"        : document.getElementById("precio").value,
                        "cantProducto"          : document.getElementById("cantidad").value,
                        "idCategoria"           : 1,
                        "imagen"                : document.getElementById("imagen").value

                    };

                    var productoJSON = JSON.stringify(producto.lista);
                    console.log(productoJSON);

                    $.post(baseurl + 'Products/create', {producto: productoJSON},
                        function(respuesta) {
                            console.log(respuesta);
                            alertify.success('Registrado')
                        }).error(
                        function(){
                            console.log('Error al ejecutar la petición');
                        });

                    location.reload(true);
                },
                function(){
                    alertify.error('Cancelado')
                });
        });


        $(document).on("click", "#btnCancelarEditarProducto", function (e) {
            $(".contenedor_editar_producto").empty();
        });

        $(document).on("click", ".close", function (e) {
            $(".contenedor_editar_producto").empty();
            $(".contenedorProductoRegistro").empty();
        });

        $(document).on("click", ".btnEditarProducto", function( e ){
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre  = $(this).data("nombre");
            var id      = $(this).data('id');
            idProducto = id;

            $.post(baseurl + 'Products/get_producto/' + id, function (data) {

                var result = JSON.parse(data);

                if(result){
                    $.each(result, function (i, val) {
                        var content = "";
                        content += '<form>';
                        content += '<div class="">';
                        content += '<label class="h6">Producto</label><br>';
                        content += '<input type="text" class="" id="producto" value="'+val.producto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Descripción</label><br>';
                        content += '<input type="text" class="md-textarea" id="descripcion" value="'+val.descripcionProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Costo</label><br>';
                        content += '<input type="text" class="" id="costo" value="'+val.costoProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Precio</label><br>';
                        content += '<input type="text" class="" id="precio" value="'+val.precioProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Cantidad</label><br>';
                        content += '<input type="text" class="" id="cantidad" value="'+val.cantProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Imagen</label><br>';
                        content += '<input type="text" class="" id="imagen" value="'+val.imagen+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Categoria</label><br>';
                        content += '<input type="text" class="categoria" id="categoria" value="'+val.idCategoria+'">';
                        content += '<div id="cargacategorias" ></div>';
                        content += '</div>';
                        content += '</form>';
                        $(".contenedor_editar_producto").append(content);
                    });
                }else{
                    //var content_ingrediente = "";
                    //content_ingrediente += '<p class="alimento'+idalimento+'">No contiene descripción</p>';
                    //$("#contenedor_des_producto").append(content_ingrediente);
                }

            });
        });

        $(document).on("click", "#btnEditProducto",function(e){
            alertify.confirm('Estas segurdo?', 'De querer editar el producto',
                function(){
                    producto.lista={
                        "producto"              : document.getElementById("producto").value,
                        "descripcionProducto"   : document.getElementById("descripcion").value,
                        "costoProducto"         : document.getElementById("costo").value,
                        "precioProducto"        : document.getElementById("precio").value,
                        "cantProducto"          : document.getElementById("cantidad").value,
                        "idCategoria"           : document.getElementById("categoria").value,
                        "imagen"                : document.getElementById("imagen").value
                    };

                    var productoJSON = JSON.stringify(producto.lista);
                    console.log(productoJSON);

                    $.post(baseurl + 'Products/edit/' + idProducto, {producto: productoJSON},
                        function(respuesta) {
                            console.log(respuesta);
                            alertify.success('Editado')
                        }).error(
                        function(){
                            console.log('Error al ejecutar la petición');
                        });

                    location.reload(true);
                },
                function(){
                    alertify.error('Cancelado')
                });
        });

        $(document).on("click", ".btnEliminarProducto", function( e ){
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre  = $(this).data("nombre");
            var id      = $(this).data('id');
            alertify.confirm('Estas segurdo?', 'De querer registrar eliminar el producto',
                function(){
                    borrarProducto(id);
                },
                function(){
                    alertify.error('Cancelado')
                });
        });

        function borrarProducto(id){
            //cuando estamos seguros que lo que queremos borrar

            $.ajax({
                type: 'POST',
                url : baseurl+'products/delete/' + id,
                dataType: 'json'
            });

            //quita la fila de la tabla
            $("#fila"+id).remove();
            alertify.success('Borrado')
        }


        //Busqueda de cateogria=========================================================================================
        //hacemos focus al campo de búsqueda
        $("#categoria").focus();
        //comprobamos si se pulsa una tecla
        $("#categoria").keyup(function (e) {

            var contenido = "";
            contenido += '<ul class="list-group" id="categorias"></ul>';
            $("#cargacategorias").append(contenido);

            var consulta;
            //obtenemos el texto introducido en el campo de búsqueda
            consulta = $("#categoria").val();
            //hace la búsqueda
            if (consulta != "") {
                $.post(baseurl + 'Categorias/buscarCategorias', {nombre: consulta}, function (mensaje) {
                    if (mensaje != '') {
                        $("#categorias").show();
                        $("#categorias").html(mensaje);
                        //console.log(mensaje);
                    } else {
                        $("#categorias").html('');
                    }
                    ;
                });
            }
        });

        $( document ).on( "click", ".cargarCategoria", function (e) {
            e.preventDefault();
            //capturamos el id de la categoria
            var idCategoria = $(this).data("id");
            //capturamos el nombre de la categoria
            var categoria = $(this).data("nombre");

            //asignamos a la variable global el valor de la variable local
            idCategoriaActual = idCategoria;
            //asignamos a la variable global el valor de la variable local
            categoriaActual = categoria;
            //al input tipo text le colocamos el valor de la variable local
            $("#categoria").val(categoria);
            $("#categorias").remove();

        });
        //Fin de la busqueda del categorias=============================================================================

    }

});



