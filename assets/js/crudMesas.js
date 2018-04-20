$(document).ready(function() {
    $("#btnCrearMesa").click(function () {

        var content = "";
        content += '<form enctype="multipart/form-data" id="frmCapturaNuevaMesa">';
        content += '<div class="md-form">';
        content += '<input minlength="3" type="number" class="form-control" name="iptNumeroMesa" id="iptNumeroMesa">';
        content += '<label class="text-danger">Numero</label>';
        content += '</div>';

        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtUbicacionMesa" id="txtUbicacionMesa">';
        content += '<label>Ubicacion</label>';
        content += '</div>';

        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtDescripcionMesa" id="txtDescripcionMesa">';
        content += '<label>Descripcion</label>';
        content += '</div>';

        content += '</form>';

        $("#divFormularioNuevaMesa").append(content);

    });


    //Al presionar el boton de registrar nueva categoria
    $("#btnNuevaMesa").click(function () {


        if ($("#iptNumeroMesa").val() == "") {
            swal("Error!", "Lo campos en rojo deben estar llenos", "error");
            return false;
        }
        $('#btnNuevaMesa').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer registrar esta mesa',
            function(){

                const form = document.getElementById('frmCapturaNuevaMesa');
                const formData = new FormData(form);


                $.ajax({

                        type: 'POST',
                        url: baseurl + 'mesas/crear',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if (res) {

                                alertify.success('Nueva Mesa Creada');


                            }

                        }


                    },
                    setInterval(function() {
                        cache_clear()
                    }, 1000));

            },
            function(){
                alertify.error('Cancelado')
            });

    });

    $(document).on("click", "#btnCancelarNuevaMesa", function () {
        $("#divFormularioNuevaMesa").empty();
    });

    $(document).on("click", "#btnEditarMesaTbl", function( e ){
        e.preventDefault();
        var idmesa = $(this).data("id");



        $.post(baseurl + 'mesas/getMesaInfo/' + idmesa, function (data) {
            var result = JSON.parse(data);

            $.each(result, function (i, val) {

                var content = "";
                content += '<form enctype="multipart/form-data" id="frmCapturaEditarMesa">';
                content += '<div class="md-form">';
                content += '<input name="txtIdMesa" type="hidden" value="'+ val.idMesa +'">';
                content += '<input value="'+ val.noMesa +'" minlength="3" type="number" class="form-control" name="iptNumeroMesa" id="iptNumeroMesa">';
                content += '<label class="text-danger">Numero</label>';
                content += '</div>';

                content += '<div class="md-form">';
                content += '<input value="'+ val.ubicacionMesa+'"  type="text" class="form-control" name="txtUbicacionMesa" id="txtUbicacionMesa">';
                content += '<label>Ubicacion</label>';
                content += '</div>';

                content += '<div class="md-form">';
                content += '<input value="'+ val.descripcionMesa +'" type="text" class="form-control" name="txtDescripcionMesa" id="txtDescripcionMesa">';
                content += '<label>Descripcion</label>';
                content += '</div>';

                content += '</form>';

                $("#divFormularioEditarMesa").append(content);
            });

        });

    });

    $("#btnEditarMesa").click(function () {

        if ($("#iptNumeroMesa").val() == "") {
            swal("Error!", "El campo nombre no puede estar vacio", "error");
            return false;
        }

        $('#btnEditarMesa').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer modificar esta mesa',
            function(){

                const form = document.getElementById('frmCapturaEditarMesa');
                const formData = new FormData(form);

                $.ajax({

                        type: 'POST',
                        url: baseurl + 'mesas/editar',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if (res) {

                                alertify.success('Mesa Modificada');

                            }

                        }
                    },
                    setInterval(function() {
                        cache_clear()
                    }, 1000));

            },
            function(){
                alertify.error('Cancelado')
            });

    });

    $(document).on("click", "#btnCancelarEditarMesa", function (e) {
        $("#divFormularioEditarMesa").empty();
    });

    $(document).on("click", "#btnEliminarMesaTbl", function(  ) {

        var id = $(this).data('id');

        alertify.confirm('Estas seguro?', 'De querer borrar esta mesa',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'mesas/eliminar',
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