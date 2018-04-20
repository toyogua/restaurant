
var categoriaSubcategoria = 0;

$(document).ready(function() {

    //al dar click sobre el boton de crear categoria en la vista categorias/listar_categorias
    $("#btnCrearCategoria").click(function () {

        $.post(baseurl + 'categorias/todasLasCategorias/', function (data) {

            var resultado = JSON.parse(data);
            $.each(resultado, function (i, val) {
                $("#divcategorias").append('<a class="dropdown-item categoriasencontradas" data-id="'+ val.idCategoria +'" data-nombre="'+ val.categoria +'" href="#">'+ val.categoria+'</a>')
            });
        });

        var content = "";
        content += '<form enctype="multipart/form-data" id="frmCapturaNuevaCategoria">';
        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtNombreCategoria" id="txtnombreCategoria">';
        content += '<label>Nombre</label>';
        content += '</div>';


        content += '<div class="row">';

        content += '<div class="col-md-8">';
        content += '<p  class="text-info">Categoria</p>';
        content += '<div class="btn-group">';
        content += '<button type="button" class="btn btn-danger">Categoria</button>';
        content += '<button style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" ' +
            'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
            '<span class="sr-only">Toggle Dropdown</span> </button>';
        content += '<div  id="divcategorias" class="dropdown-menu">';
        content += '</div>';

        content += '</div>'; //fin <div class="btn-group">
        content += '</div>'; //fin <div class="col-md-4">

        content += '<div class="col-md-3">';
        content += '<label class="text-success accent-4" id="lblCategoria"></label>';
        content += '</div>';


        content += '</div><br>'; //fin <div class="row">
        content += '</form>';

        $("#formularioCrearCategoria").append(content);
    });

    $(document).on("click", ".categoriasencontradas", function () {
        var nombre = $(this).data("nombre");
        var id = $(this).data("id");

        $("#lblCategoria").text("Seleccionó:  " + nombre );

         categoriaSubcategoria= id;

    });


    //Al presionar el boton de registrar nueva categoria
    $("#bntNuevaCategoria").click(function () {


        if ($("#txtnombreCategoria").val() == ""){
            swal("Error!", "El campo nombre no puede estar vacio", "error")
            return false;
        }

        alertify.confirm('Estas seguro?', 'De querer registrar esta Sub Categoria',
            function(){

                const form = document.getElementById('frmCapturaNuevaCategoria');
                const formData = new FormData(form);
                formData.append("idcategoria", categoriaSubcategoria);

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


    //click sobre alguna categoria mostrada en todo el listado
    $(document).on("click", "#btnEditarCategoriaTbl", function( e ){
        e.preventDefault();
        var categoria = $(this).data("id");
        $.post(baseurl + 'Categorias/getSubCategoriaInfo/' + categoria, function (data) {
            var result = JSON.parse(data);

            $.each(result, function (i, val) {

                var content = "";
                content += '<form enctype="multipart/form-data" id="frmEditarCategoria">';
                content += '<input id="txtidsubcategoria" name="txtidsubcategoria" type="hidden" value="'+ val.idSubcategoria +'">';
                content += '<div class="">';
                content += '<label class="h6">Nombre</label><br>';
                content += '<input type="text" class="" name="txtNombreCategoria" id="txtNombreCategoria" value="'+ val.nombre +'">';
                content += '</div>';

                content += '<input id="txtidcategoria" type="hidden" value="'+ val.idCategoria +'">';
                content += '<div class="text-primary"><p class="btn-group">La categoria actual es : '+ val.categoria +'</p></div>';

                content += '<div class="row">';
                content += '<div class="col-md-8">';
                content += '<p  class="text-info">Categoria</p>';
                content += '<div class="btn-group">';
                content += '<button type="button" class="btn btn-danger">Categoria</button>';
                content += '<button id="btncargarsubcategorias" style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" ' +
                    'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    '<span class="sr-only">Toggle Dropdown</span> </button>';
                content += '<div  id="divcategorias" class="dropdown-menu">';
                content += '</div>';

                content += '</div>'; //fin <div class="btn-group">
                content += '</div>'; //fin <div class="col-md-4">

                content += '<div class="col-md-3">';
                content += '<label class="text-success accent-4" id="lblCategoria"></label>';
                content += '</div>';


                content += '</div><br>'; //fin <div class="row">
                content += '</form>';

                $("#formularioEditarCategoria").append(content);

            });

        });
    });

    $(document).on("click", "#btnCancelarEditarCategoria", function (e) {
        $("#formularioEditarCategoria").empty();
    });



    //se crea una funcion por aparte para solo cargar los tipos de empleados para evitar conflictos en el modal
    //de editar una subcategoria
    $(document).on("click", "#btncargarsubcategorias", function( ) {
        $("#divcategorias").empty();

        $.post(baseurl + 'categorias/todasLasCategorias/', function (data) {

            var resultado = JSON.parse(data);


            $.each(resultado, function (i, val) {
                $("#divcategorias").append('<a class="dropdown-item categoriasencontradas" data-id="'+ val.idCategoria +'" data-nombre="'+ val.categoria +'" href="#">'+ val.categoria+'</a>')
            });
        });
    });

    //click sobre el boton de editar dentro del modal
    $(document).on("click", "#btnEditarCategoria", function(  ) {

        var nombresubcategoria  = $("#txtNombreCategoria").val();
        var idsubcategoria      = $("#txtidsubcategoria").val();

        if ( categoriaSubcategoria === 0 ){
           categoriaSubcategoria = $("#txtidcategoria").val();
        }
        console.log(categoriaSubcategoria);

        alertify.confirm('Estas segurdo?', 'De querer editar esta categoria',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'categorias/edit',
                    dataType: 'json',
                    data: {nombre: nombresubcategoria, subcategoria: idsubcategoria, idcategoria:categoriaSubcategoria },
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