
$(document).ready(function() {

    //al dar click sobre el boton de crear categoria en la vista categorias/listar_categorias
    $("#btnCrearCategoria").click(function () {

        var content = "";
        content += '<form enctype="multipart/form-data" id="frmCapturaNuevaCategoria">';
        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtNombreCategoria" id="txtnombreCategoria">';
        content += '<label>Nombre</label>';
        content += '</div>';
        content += '<div class="md-form">';
        content += '<textarea type="text" class="md-textarea form-control" name="txtDescripcionCategoria" id="txtDescrpcionCategoria"></textarea>';
        content += '<label>Descripción</label>';
        content += '</div>';
        content += '</form>';

        $("#formularioCrearCategoria").append(content);
    });


    //Al presionar el boton de registrar nueva categoria
    $("#bntNuevaCategoria").click(function () {


        if ($("#txtnombreCategoria").val() == ""){
            swal("Error!", "El campo nombre no puede estar vacio", "error")
            return false;
        }

        alertify.confirm('Estas seguro?', 'De querer registrar esta Categoria',
            function(){

                const form = document.getElementById('frmCapturaNuevaCategoria');
                const formData = new FormData(form);

                $.ajax({

                    type: 'POST',
                    url: baseurl + 'categorias/create',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res) {

                            alertify.success('Categoria Creada');


                        }

                    }


                },  setInterval(function() {
                    cache_clear()
                }, 1000));

            },
            function(){
                alertify.error('Cancelado')
            });

    });

    $(document).on("click", "#btnCancelarNuevaCategoria", function () {
        $("#formularioCrearCategoria").empty();
    });

    $(document).on("click", "bntNuevaCategoria", function () {
        $("#formularioCrearCategoria").empty();
    });

    //click sobre alguna categoria mostrada en todo el listado
    $(document).on("click", "#btnEditarCategoriaTbl", function( e ){
        e.preventDefault();
        var idcategoria = $(this).data("id");
        $.post(baseurl + 'Categorias/getCategoriaInfo/' + idcategoria, function (data) {
            var result = JSON.parse(data);
            console.log(result);
            $.each(result, function (i, val) {

                var content = "";
                content += '<form enctype="multipart/form-data" id="frmEditarCategoria">';
                content += '<div class="">';
                content += '<label class="h6">Producto</label><br>';
                content += '<input type="text" class="" name="txtNombreCategoria" id="txtNombreCategoria" value="'+val.categoria+'">';
                content += '</div>';
                content += '<div class="">';
                content += '<label class="h6">Descripción</label><br>';
                content += '<input id="txtidcategoria" type="hidden" data-idcategoria="'+ val.idCategoria+'">';
                content += '<input type="text" class="md-textarea" name="txtDescripcionCategoria" id="txtDescripcionCategoria" value="'+val.descripcionCategoria+'">';
                content += '</div>';
                content += '</form>';

                $("#formularioEditarCategoria").append(content);

            });

        });
    });

    $(document).on("click", "#btnCancelarEditarCategoria", function (e) {
        $("#formularioEditarCategoria").empty();
    });

    $(document).on("click", "btnEditarCategoria", function (e) {
        $("#formularioEditarCategoria").empty();
    });

    //click sobre el boton de editar dentro del modal
    $(document).on("click", "#btnEditarCategoria", function(  ) {

        var nombrecategoria = $("#txtNombreCategoria").val();
        var descripcioncategoria = $("#txtDescripcionCategoria").val();
        var idcategoria = $("#txtidcategoria").data("idcategoria");

        alertify.confirm('Estas segurdo?', 'De querer editar esta categoria',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'categorias/edit',
                    dataType: 'json',
                    data: {nombre: nombrecategoria, descripcion: descripcioncategoria, idcategoria:idcategoria },
                    success: function (res) {
                        console.log(res);
                        if (res) {

                            alertify.success('Actualizada');
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

    $(document).on("click", "#btnEliminarCategoria", function(  ) {

        var id = $(this).data('id');

        alertify.confirm('Estas seguro?', 'De querer borrar esta categoria',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'categorias/delete',
                    dataType: 'json',
                    data: {id: id },
                    success: function (res) {
                        console.log(res);
                        if (res) {
                            $("#fila"+id).remove();
                            alertify.success('Eliminada');
                        }

                    }
                });

            },
            function(){
                alertify.error('Cancelado')
            });

    });

});