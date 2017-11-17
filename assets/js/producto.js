/**
 * Created by DELEON on 10-Nov-17.
 */

var baseurl = 'http://localhost/restaurant/';
var producto = {
    lista: []
};

var idIngrediente = 0;
$(document).ready(function() {

    //console.log(hora);
    if( window.location.href === baseurl + 'products/display'){

        $(document).on("click", ".btnNuevoProducto", function (e) {
            var content = "";
            content += '<form>';
            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" id="ingrediente">';
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
            content += '<input type="text" class="form-control" id="cantidad">';
            content += '<label>Precio</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<label>Cantidad</label><br>';
            content += '<input type="text" class="form-control" id="fecha">';
            content += '</div>';
            //content += '</div>';
            content += '</form>';
            $(".contenedorProductoRegistro").append(content);
        });

        $(document).on("click", "#btnCancelarRegistroIngreddiente", function (e) {
            $(".contenedorProductoRegistro").empty();
        });

        $(document).on("click", "#btnRegistrarProducto", function (e) {

            alertify.confirm('Estas segurdo?', 'De querer registrar este producto',
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

                    $.post(baseurl + 'Products/create', {producto: ordenJSON},
                        function(respuesta) {
                            console.log(respuesta);
                            alertify.success('Registrado')
                        }).error(
                        function(){
                            console.log('Error al ejecutar la petición');
                        });

                    location.reload(true);
                    //$("#modaIngrediente").hide();
                    //$("body").show();
                    //$(".contenedorIngredienteRegistro").empty();

                },
                function(){
                    alertify.error('Cancelado')
                });
        });


        $(document).on("click", "#btnCancelarEditarIngrediente", function (e) {
            $(".contenedor_editar_ingrediente").empty();
        });

        $(document).on("click", ".btnEditarIngrediente", function( e ){
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre  = $(this).data("nombre");
            var id      = $(this).data('id');
            idIngrediente = id;

            $.post(baseurl + 'Ingredientes/get_ingrediente/' + id, function (data) {

                var result = JSON.parse(data);

                if(result){
                    $.each(result, function (i, val) {
                        var content = "";
                        content += '<form>';
                        content += '<div class="">';
                        content += '<label class="h6">Ingrediente</label><br>';
                        content += '<input type="text" class="" id="ingrediente" value="'+val.ingrediente+'">';
                        content += '</div><br>';
                        content += '<div class="">';
                        content += '<label class="h6">Descripción</label><br>';
                        content += '<input type="text" id="descripcion" value="'+val.descripcionIngrediente+'">';
                        content += '</div><br>';
                        content += '<div class="">';
                        content += '<label class="h6">Costo</label><br>';
                        content += '<input type="text" class="" id="costo" value="'+val.costoIngrediente+'">';
                        content += '</div><br>';
                        content += '<div class="">';
                        content += '<label class="h6">Cantidad</label><br>';
                        content += '<input type="text" class="" id="cantidad" value="'+val.cantIngrediente+'">';
                        content += '</div><br>';
                        content += '<div class="">';
                        content += '<label class="h6">Fecha de Ingreso</label><br>';
                        content += '<input type="date" class="" id="fecha" value="'+val.fechaIngreso+'">';
                        content += '</div>';
                        content += '</form>';
                        $(".contenedor_editar_ingrediente").append(content);
                    });
                }else{
                    //var content_ingrediente = "";
                    //content_ingrediente += '<p class="alimento'+idalimento+'">No contiene descripción</p>';
                    //$("#contenedor_des_producto").append(content_ingrediente);
                }

            });
        });

        $(document).on("click", "#btnEditIngrediente",function(e){
            alertify.confirm('Estas segurdo?', 'De querer editar el ingrediente',
                function(){
                    ingredientes.lista={
                        "ingrediente"               : document.getElementById("ingrediente").value,
                        "ingredienteDescripcion"    : document.getElementById("descripcion").value,
                        "costoIngrediente"          : document.getElementById("costo").value,
                        "cantIngrediente"           : document.getElementById("cantidad").value,
                        "fechaIngreso"              : document.getElementById("fecha").value
                    };

                    var ordenJSON = JSON.stringify(ingredientes.lista);
                    console.log(ordenJSON);

                    $.post(baseurl + 'Ingredientes/edit/' + idIngrediente, {ingredientes: ordenJSON},
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

        $(document).on("click", ".btnEliminarIngrediente", function( e ){
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre  = $(this).data("nombre");
            var id      = $(this).data('id');
            alertify.confirm('Estas segurdo?', 'De querer registrar eliminar el ingrediente',
                function(){
                    borrarIngrediente(id);
                },
                function(){
                    alertify.error('Cancelado')
                });
        });

        function borrarIngrediente(id){
            //cuando estamos seguros que lo que queremos borrar

            $.ajax({
                type: 'POST',
                url : baseurl+'ingredientes/delete/' + id,
                dataType: 'json'
            });

            //quita la fila de la tabla
            $("#fila"+id).remove();
            alertify.success('Borrado')
        }

    }

});



