

var ingredientes = {
    lista: []
};

var idIngrediente = 0;
$(document).ready(function() {



        $(document).on("click", ".btnNuevoIngrediente", function (e) {
            var content = "";
            content += '<form>';

            content += '<div class="md-form offset-1">';

            content += '<p class="text-info ">Tipo Inventario: </p>';
            content += '<div class="row">';
            content += '<div class="col-md-1"><label for="riventario1">Barra</label></div>';
            content += '<div class="col-md 2">';
            content += '<input checked class="" name="inventario" type="radio" id="riventario1" value="1">';
            content += '</div>';

            content += '<div class="col-md-1"><label for="riventario">Cocina</label></div>';
            content += '<div class="col-md 2">';
            content += '<input class="" name="inventario" type="radio" id="riventario2" value="2">';
            content += '</div>';
            content += '</div>';
            content += '</div>';

            content += '<div class="md-form">';

            content += '<div class="md-form">';
            content += '<input type="text" class="form-control" id="ingrediente">';
            content += '<label>Ingrediente</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<textarea type="text" class="md-textarea form-control" id="descripcion"></textarea>';
            content += '<label>Descripción</label>';
            content += '</div>';
            //content += '<div class="row">';
            content += '<div class="md-form">';
            content += '<input type="number" class="form-control" id="costo">';
            content += '<label>Costo</label>';
            content += '</div>';
            content += '<div class="md-form">';
            content += '<input type="number" class="form-control" id="cantidad">';
            content += '<label>Cantidad</label>';
            content += '</div>';

            content += '<div class="md-form">';
            content += '<p class="text-info">Elija la unidad de medida</p>';
            content += '<div class="row">';
            content += '<div class="col-md-1"><label for="rgramos">Gramos</label></div>';
            content += '<div class="col-md 2">';
            content += '<input checked class="rmedida" name="rmedida" type="radio" id="rgramos" value="Gramos">';
            content += '</div>';

            content += '<div class="col-md-1"><label for="runidad">Unidad</label></div>';
            content += '<div class="col-md 2">';
            content += '<input class="rmedida" name="rmedida" type="radio" id="runidad" value="Unidad">';
            content += '</div>';
            content += '</div>';
            content += '</div>';

            content += '<div class="md-form">';

            content += '<label>Fecha de Ingreso</label><br>';
            content += '<input type="date" class="form-control" id="fecha">';
            content += '</div>';
            //content += '</div>';
            content += '</form>';
            $(".contenedorIngredienteRegistro").append(content);
        });

        $(document).on("click", "#btnCancelarRegistroIngreddiente", function (e) {
            $(".contenedorIngredienteRegistro").empty();
        });

        $(document).on("click", "#btnRegistrarIngrediente", function (e) {
            //detectamos los radio button presionados
            var medida = $('input:radio[name=rmedida]:checked').val();
            var inventario = $('input:radio[name=inventario]:checked').val();

            alertify.confirm('Estás seguro?', 'De querer registrar este ingrediente',
                function(){
                    ingredientes.lista={
                        "ingrediente"               : document.getElementById("ingrediente").value,
                        "ingredienteDescripcion"    : document.getElementById("descripcion").value,
                        "costoIngrediente"          : document.getElementById("costo").value,
                        "cantIngrediente"           : document.getElementById("cantidad").value,
                        "fechaIngreso"              : document.getElementById("fecha").value,
                        "medida"                    : medida,
                        "inventario"                : inventario
                    };

                    var ordenJSON = JSON.stringify(ingredientes.lista);
                    console.log(ordenJSON);

                    $.ajax({
                        type: "POST",
                        url: baseurl + 'Ingredientes/create',
                        dataType: 'json',
                        data: {ingredientes: ordenJSON},
                        success: function (res) {
                            console.log(res);
                            if (res) {

                                alertify.success('Registrado');
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

                        content += '<div class="md-form offset-1">';

                        content += '<p class="text-info ">Tipo Inventario: Actualmente = '+ val.tipo + ' </p>';
                        content += '<div class="row">';
                        content += '<div class="col-md-1"><label for="riventario1">Barra</label></div>';
                        content += '<div class="col-md 2">';
                        content += '<input checked class="" name="inventario" type="radio" id="riventario1" value="1">';
                        content += '</div>';

                        content += '<div class="col-md-1"><label for="riventario">Cocina</label></div>';
                        content += '<div class="col-md 2">';
                        content += '<input class="" name="inventario" type="radio" id="riventario2" value="2">';
                        content += '</div>';
                        content += '</div>';
                        content += '</div>';

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
                        content += '<input type="number" class="" id="costo" value="'+val.costoIngrediente+'">';
                        content += '</div><br>';
                        content += '<div class="">';
                        content += '<label class="h6">Cantidad</label><br>';
                        content += '<input type="number" class="" id="cantidad" value="'+val.cantIngrediente+'">';
                        content += '</div><br>';

                        content += '<div class="md-form">';
                        content += '<p class="text-info">Elija la unidad de medida: '+ val.medida+'</p>';
                        content += '<div class="row">';
                        content += '<div class="col-md-1"><label for="rgramos">Gramos</label></div>';
                        content += '<div class="col-md 2">';
                        content += '<input checked class="rmedida" name="rmedida" type="radio" id="rgramos" value="Gramos">';
                        content += '</div>';

                        content += '<div class="col-md-1"><label for="runidad">Unidad</label></div>';
                        content += '<div class="col-md 2">';
                        content += '<input class="rmedida" name="rmedida" type="radio" id="runidad" value="Unidad">';
                        content += '</div>';
                        content += '</div>';
                        content += '</div>';

                        content += '<div class="">';
                        content += '<label class="h6">Fecha de Ingreso</label><br>';
                        content += '<input type="date" class="" id="fecha" value="'+val.fechaIngreso+'">';
                        content += '</div>';
                        content += '</form>';
                        $(".contenedor_editar_ingrediente").append(content);
                    });
                }

            });
        });

        $(document).on("click", "#btnEditIngrediente",function(e){
            //detectamos los radio button presionados
            var medida = $('input:radio[name=rmedida]:checked').val();
            var inventario = $('input:radio[name=inventario]:checked').val();

            alertify.confirm('Estás seguro?', 'De querer editar el ingrediente',
                function(){
                    ingredientes.lista={
                        "ingrediente"               : document.getElementById("ingrediente").value,
                        "ingredienteDescripcion"    : document.getElementById("descripcion").value,
                        "costoIngrediente"          : document.getElementById("costo").value,
                        "cantIngrediente"           : document.getElementById("cantidad").value,
                        "fechaIngreso"              : document.getElementById("fecha").value,
                        "medida"                    : medida,
                        "inventario"                : inventario,
                        "idingrediente"             : idIngrediente
                    };

                    var ordenJSON = JSON.stringify(ingredientes.lista);
                    console.log(ordenJSON);

                    $.ajax({
                        type: "POST",
                        url: baseurl + 'Ingredientes/edit',
                        dataType: 'json',
                        data: {ingredientes: ordenJSON},
                        success: function (res) {
                            console.log(res);
                            if (res) {

                                alertify.success('Actualizado');
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

        $(document).on("click", ".btnEliminarIngrediente", function( e ){
            e.preventDefault();//para que no recargue la pagina, no redirecciona con el link

            //nombre tomado del data-nombre
            var nombre  = $(this).data("nombre");
            var id      = $(this).data('id');
            alertify.confirm('Estas seguro?', 'De querer registrar eliminar el ingrediente',
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





});



