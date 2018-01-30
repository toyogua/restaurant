
var producto = {
    lista: []
};


idCategoriaActual = 0;
categoriaActual = "";
categoriaseleccionada = 0;

var idProducto = 0;

$(document).ready(function() {

    //console.log(hora);
    if( window.location.href === baseurl + 'Products/display'){

        $(document).on("click", ".btnNuevoProducto", function () {

            var content = "";
            content += '<form enctype="multipart/form-data" id="formcrearproducto">';
            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" name="producto" id="producto">';
            content += '<label>Producto</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<textarea type="text" class="md-textarea form-control" name="descripcion" id="descripcion"></textarea>';
            content += '<label>Descripción</label>';
            content += '</div>';
            //content += '<div class="row">';
            content += '<div class="md-form">';
            content += '<input type="number" class="form-control" name="costo" id="costo">';
            content += '<label>Costo</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<input type="number" class="form-control" name="precio" id="precio">';
            content += '<label>Precio</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<label>Cantidad</label>';
            content += '<input type="number" class="form-control" name="cantidad" id="cantidad">';
            content += '</div>';
            content += '<div class="">';
            content += '<h6>Imagen</h6><br>';
            content += '<input name="imagen" type="file"  id="imagen">';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<label>Categoria</label>';
            content += '<input type="text" class="form-control categoria" name="categoria" id="categoria">';
            content += '<ul  id="rescategorias"></ul>';
            content += '</div>';

            $(".contenedorProductoRegistro").append(content);
        });





        $(document).on("click", "#categoria", function (){
            $("#categoria").focus();
            //comprobamos si se pulsa una tecla
            $("#categoria").keyup(function()
            {
                consulta = $("#categoria").val();

                $.post(baseurl+'products/getCategoriaJson', {categoria: consulta}, function(mensaje)
                {
                    if (mensaje!= '')
                    {
                        $("#rescategorias").show();
                        $("#rescategorias").html(mensaje);

                    } else
                    {
                        $("#rescategorias").html('');
                    };
                });
            });

        });

        //destruir contenido de formulario al dar click en cancelar en el modal
        $(document).on("click", "#btnCancelarRegistroProducto", function () {
            $("#formularionuevoproducto").empty();

        });

        //al dar click sobre una de las categoorias encontradas
        $(document).on("click", ".encategorias", function () {
            var idcategoria_sel = $(this).data("id");
            var nombrecategoria = $(this).data("nombre");

            categoriaseleccionada =  idcategoria_sel;

            $("#categoria").val(nombrecategoria);
            $("#rescategorias").remove();
        });


        $(document).on("click", "#btnCancelarRegistroIngreddiente", function () {
            $(".contenedorProductoRegistro").empty();

        });

        $(document).on("click", "#btnRegistrarProducto", function () {



            alertify.confirm('Estas seguro?', 'De querer registrar este producto',
                function(){

                    producto.lista={
                        "producto"              : document.getElementById("producto").value,
                        "descripcionProducto"   : document.getElementById("descripcion").value,
                        "costoProducto"         : document.getElementById("costo").value,
                        "precioProducto"        : document.getElementById("precio").value,
                        "cantProducto"          : document.getElementById("cantidad").value,
                        "idCategoria"           : categoriaseleccionada
                        //"imagen"                : document.getElementById("imagen").value

                    };

                    const form = document.getElementById('formcrearproducto');
                    const formData = new FormData(form);
                    formData.append("categoria", categoriaseleccionada);


                    var productoJSON = JSON.stringify(producto.lista);

                    $.ajax({
                        // type: "POST",
                        // url: baseurl + 'products/create',
                        // dataType: 'json',
                        //
                        // data:{producto:productoJSON} ,
                        type: 'POST',
                        url: baseurl + 'products/create',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            console.log(res);
                            if (res) {

                                alertify.success('Registrado');


                            }
                            else {
                                console.log("Error al enviar los alimentos")
                            }


                        }


                    },  setInterval(function() {
                        //cache_clear()
                    }, 1000));

                    // setInterval(function() {
                    //     cache_clear()
                    // }, 1000);
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
            var id      = $(this).data("id");
            idProducto = id;


            $.post(baseurl + 'Products/get_producto/' + id, function (data) {

                var result = JSON.parse(data);

                if(result){
                    $.each(result, function (i, val) {
                        var content = "";
                        content += '<form enctype="multipart/form-data" id="formeditarproducto">';
                        content += '<div class="">';
                        content += '<label class="h6">Producto</label><br>';
                        content += '<input type="text" class="" name="producto" id="producto" value="'+val.producto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Descripción</label><br>';
                        content += '<input type="text" class="md-textarea" name="descripcion" id="descripcion" value="'+val.descripcionProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Costo</label><br>';
                        content += '<input type="text" class="" name="costo" id="costo" value="'+val.costoProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Precio</label><br>';
                        content += '<input type="text" class="" name="precio" id="precio" value="'+val.precioProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Cantidad</label><br>';
                        content += '<input type="text" class="" name="cantidad" id="cantidad" value="'+val.cantProducto+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Imagen</label><br>';
                        content += '<input type="file" name="imagen" id="imagen">';
                        content += '<input type="hidden" name="imgcon" id="imgcon" value="'+val.imghx+'">';
                        content += '<img style="border-radius: 150px; height: 50px; width: 50px;"  src=".'+val.imghx+'">';
                        content += '</div>';
                        content += '<div class="">';
                        content += '<label class="h6">Categoria</label><br>';
                        content += '<input type="text" class="categoria" name="categoria" data-id="'+val.idCategoria+'" id="categoria" value="'+val.categoria+'">';
                        content += '<ul  id="rescategorias"></ul>';
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

        $(document).on("click", "#btnEditProducto",function(){

            if(categoriaseleccionada === 0){
                categoriaseleccionada = $("#categoria").data("id");
            }
            alertify.confirm('Estas segurdo?', 'De querer editar el producto',

                function(){
                    producto.lista={
                        "producto"              : document.getElementById("producto").value,
                        "descripcionProducto"   : document.getElementById("descripcion").value,
                        "costoProducto"         : document.getElementById("costo").value,
                        "precioProducto"        : document.getElementById("precio").value,
                        "cantProducto"          : document.getElementById("cantidad").value,
                        "idCategoria"           : categoriaseleccionada,
                        "imagen"                : document.getElementById("imagen").value
                    };

                    var productoJSON = JSON.stringify(producto.lista);

                    console.log(producto.lista);

                    const form = document.getElementById('formeditarproducto');
                    const formData = new FormData(form);
                    formData.append("categoria", categoriaseleccionada);
                    formData.append("idproducto", idProducto);



                    $.ajax({
                        // type: "POST",
                        // url: baseurl + 'products/edit',
                        // dataType: 'json',
                        // data: {idproducto:idProducto, producto: productoJSON},
                        type: 'POST',
                        url: baseurl + 'products/edit',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            console.log(res);
                            if (res) {

                                alertify.success('Producto Actualizado');

                            }

                        }
                    });


                    setInterval(function() {
                        cache_clear()
                    }, 1000);

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
            alertify.success('Borrado');

            setInterval(function() {
                cache_clear()
            }, 1000);

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

    function cache_clear() {
        window.location.reload(true);
        // window.location.reload(); use this if you do not remove cache
    }

});



