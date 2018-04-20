var idTipoEmpleado  = 0;
$(document).ready(function() {
    $("#btnNuevoEmpleado").click(function () {

        $.post(baseurl + 'empleados/getTipoEmpleado/', function (data) {
            var result = JSON.parse(data);

            $.each(result, function (i, val) {
                $("#tiposempleados").append('<a class="dropdown-item tiposempleados" data-idtipoempleado="'+ val.idTipoEmpleado +'" data-tipo="'+ val.tipoEmpleado +'" href="#">'+ val.tipoEmpleado+'</a>')
            });
        });



        var content = "";
        content += '<form enctype="multipart/form-data" id="frmCapturaNuevoEmpleado">';
        content += '<div class="md-form">';
        content += '<input placeholder="Minimo 3 Letras" minlength="3" type="text" class="form-control" name="txtNombreEmpleado" id="txtNombreEmpleado">';
        content += '<label class="text-danger">Nombres</label>';
        content += '</div>';
        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtApellidoEmpleado" id="txtApellidoEmpleado">';
        content += '<label>Apellidos</label>';
        content += '</div>';
        content += '<div class="md-form">';
        content += '<input  type="text" class="form-control" name="txtDirecionEmpleado" id="txtDirecionEmpleado">';
        content += '<label>Direccion</label>';
        content += '</div>';
        content += '<div class="md-form">';
        content += '<input  type="tel" class="form-control" name="txtTelefonoEmpleado" id="txtTelefonoEmpleado">';
        content += '<label>Telefono</label>';
        content += '</div>';
        content += '<div class="md-form">';
        content += '<input  type="email" class="form-control" name="txtEmailEmpleado" id="txtEmailEmpleado">';
        content += '<label class="text-danger">Email</label>';
        content += '</div>';

        content += '<div class="row">';

        content += '<div class="col-md-8">';
        content += '<p  class="text-info">Seleccciona el tipo de empleado</p>';
        content += '<div class="btn-group">';
        content += '<button type="button" class="btn btn-danger">Tipo Empleado</button>';
        content += '<button style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" ' +
            'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
            '<span class="sr-only">Toggle Dropdown</span> </button>';
        content += '<div  id="tiposempleados" class="dropdown-menu">';
        content += '</div>';

        content += '</div>'; //fin <div class="btn-group">
        content += '</div>'; //fin <div class="col-md-4">

        content += '<div class="col-md-3">';
        content += '<label class="text-success accent-4" id="lblTipoEmpleadoSeleccionado"></label>';
        content += '</div>';


        content += '</div><br>'; //fin <div class="row">

        content += '<div class="md-form">';
        content += '<input placeholder="Minimo 4 digitos" minlength="4" type="password" class="form-control" name="txtClaveEmpleado" id="txtClaveEmpleado">';
        content += '<label>Clave</label>';
        content += '</div>';
        content += '</form>';

        $("#divFormCrearEmpleado").append(content);
    });

    $(document).on("click", ".tiposempleados", function () {
        var tipo = $(this).data("tipo");
        var idtipo = $(this).data("idtipoempleado");

        $("#lblTipoEmpleadoSeleccionado").text("Seleccionó:  " + tipo );

        idTipoEmpleado = idtipo;

    });

    //Al presionar el boton de registrar nueva categoria
    $("#btnRegistrarEmpleado").click(function () {


        if ($("#txtNombreEmpleado").val() == "" || $("#txtEmailEmpleado").val() == "" || $("#txtEmailEmpleado").val() == "") {
            swal("Error!", "Lo campos en rojo deben estar llenos", "error");
            return false;
        }
        $('#btnRegistrarEmpleado').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer registrar este empleado',
            function(){

                const form = document.getElementById('frmCapturaNuevoEmpleado');
                const formData = new FormData(form);
                formData.append("idTipoEmpleado", idTipoEmpleado);

                $.ajax({

                    type: 'POST',
                    url: baseurl + 'empleados/crearEmpleado',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res) {

                            alertify.success('Nuevo Empleado Creado');


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

    $(document).on("click", "#btnCancelarRegistrarEmpleado", function (e) {
        $("#divFormCrearEmpleado").empty();
    });

    $(document).on("click", "btnRegistrarEmpleado", function (e) {
        $(".divFormCrearEmpleado").empty();
    });

    //se crea una funcion por aparte para solo cargar los tipos de empleados para evitar conflictos en el modal
    //de editar un empleado
    $(document).on("click", "#btnCargarTipos", function( ) {
        $("#tiposempleados").empty();

        $.post(baseurl + 'empleados/getTipoEmpleado/', function (data) {
            var result = JSON.parse(data);

            $.each(result, function (i, val) {
                $("#tiposempleados").append('<a class="dropdown-item tiposempleados" data-idtipoempleado="'+ val.idTipoEmpleado +'" data-tipo="'+ val.tipoEmpleado +'" href="#">'+ val.tipoEmpleado+'</a>')
            });
        });
    });

    $(document).on("click", "#btnEditarEmpleadoTbl", function( e ){
        e.preventDefault();
        var idmpleado = $(this).data("id");



        $.post(baseurl + 'empleados/getEmpleadoInfo/' + idmpleado, function (data) {
            var result = JSON.parse(data);
            console.log( result );
            $.each(result, function (i, val) {

                var content = "";
                content += '<form enctype="multipart/form-data" id="frmCapturaEditarEmpleado">';
                content += '<input name="txtIdEmpleado" type="hidden" value="'+ val.idEmpleado +'">';
                content += '<div class="md-form">';
                content += '<input placeholder="Nombres" value="'+ val.nombresEmpleado +'" placeholder="Minimo 3 Letras" minlength="3" type="text" class="form-control" name="txtNombreEmpleado" id="txtNombreEmpleado">';

                content += '</div>';
                content += '<div class="md-form">';
                content += '<input placeholder="Apellidos" value="'+ val.apellidosEmpleado +'" type="text" class="form-control" name="txtApellidoEmpleado" id="txtApellidoEmpleado">';

                content += '</div>';
                content += '<div class="md-form">';
                content += '<input placeholder="Direccion" value="'+ val.direccionEmpleado +'" type="text" class="form-control" name="txtDirecionEmpleado" id="txtDirecionEmpleado">';

                content += '</div>';
                content += '<div class="md-form">';
                content += '<input placeholder="Telefono" value="'+ val.telefonoEmpleado +'" type="tel" class="form-control" name="txtTelefonoEmpleado" id="txtTelefonoEmpleado">';

                content += '</div>';
                content += '<div class="md-form">';
                content += '<input placeholder="Email" value="'+ val.emailEmpleado +'" type="email" class="form-control" name="txtEmailEmpleado" id="txtEmailEmpleado">';

                content += '</div>';
                content += '<input id="txtidTipoEmpleado" type="hidden" value="'+ val.idTipoEmpleado +'">';
                content += '<div class="text-primary"><p class="btn-group">El tipo de empleado actual es: '+ val.tipoEmpleado +'</p></div>';
                content += '<div class="row">';

                content += '<div class="col-md-8">';
                content += '<p  class="text-info">Seleccciona el tipo de empleado</p>';
                content += '<div class="btn-group">';
                content += '<button type="button" class="btn btn-danger">Tipo Empleado</button>';
                content += '<button id="btnCargarTipos" style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" ' +
                    'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    '<span class="sr-only">Toggle Dropdown</span> </button>';
                content += '<div  id="tiposempleados" class="dropdown-menu">';
                content += '</div>';

                content += '</div>'; //fin <div class="btn-group">
                content += '</div>'; //fin <div class="col-md-4">

                content += '<div class="col-md-3">';
                content += '<label class="text-success accent-4" id="lblTipoEmpleadoSeleccionado"></label>';
                content += '</div>';


                content += '</div><br>'; //fin <div class="row">

                content += '<div class="md-form">';
                content += '<input placeholder="Usuario" value="'+ val.username +'" minlength="4" type="text" class="form-control" name="txtUsername" id="txtUsername">';

                content += '</div>';
                content += '<div class="md-form">';
                content += '<input placeholder="Clave Minimo 4 digitos" minlength="4" type="password" class="form-control" name="txtClaveEmpleado" id="txtClaveEmpleado">';
                content += '</div>';
                content += '</form>';

                $("#divFormEditarEmpleado").append(content);
            });

        });

    });


    $("#btnEditarEmpleaddo").click(function () {

        if ($("#txtNombreEmpleado").val() == "" || $("#txtEmailEmpleado").val() == "" || $("#txtEmailEmpleado").val() == "") {
            swal("Error!", "Lo campos en rojo deben estar llenos", "error");
            return false;
        }

        if ( idTipoEmpleado === 0 ){
            idTipoEmpleado = $("#txtidTipoEmpleado").val();
        }

        $('#btnEditarEmpleaddo').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer modificar este empleado',
            function(){

                const form = document.getElementById('frmCapturaEditarEmpleado');
                const formData = new FormData(form);
                formData.append("idTipoEmpleado", idTipoEmpleado);

                $.ajax({

                        type: 'POST',
                        url: baseurl + 'empleados/editarEmpleado',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if (res) {

                                alertify.success('Empleado modificado');

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

    $(document).on("click", "#btnCancelarEditarEmpleado", function (e) {
        $("#divFormEditarEmpleado").empty();
    });

    $(document).on("click", "btnEditarEmpleaddo", function (e) {
        $(".divFormEditarEmpleado").empty();
    });

    $(document).on("click", "#btnEliminarEmpleadoTlb", function(  ) {

        var id = $(this).data('id');

        alertify.confirm('Estas seguro?', 'De querer borrar este empleado',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'empleados/eliminar',
                    dataType: 'json',
                    data: {id: id },
                    success: function (res) {
                        console.log(res);
                        if (res) {
                            $("#fila"+id).remove();
                            alertify.success('Eliminado');
                        }

                    }
                });

            },
            function(){
                alertify.error('Cancelado')
            });

    });

    $("#btnNuevoTipoEmpleado").click(function () {

        var content = "";
        content += '<form enctype="multipart/form-data" id="frmCapturaNuevoTipoEmpleado">';
        content += '<div class="md-form">';
        content += '<input placeholder="Minimo 3 Letras" minlength="3" type="text" class="form-control" name="txtNombreTipoEmpleado" id="txtNombreTipoEmpleado">';
        content += '<label class="text-danger">Tipo</label>';
        content += '</div>';
        content += '</form>';

        $("#divFormNuevoTipoEmpleado").append(content);
    });

    $("#btnCrearTipoEmpleado").click(function () {

        if ($("#txtNombreTipoEmpleado").val() == "") {
            swal("Error!", "El campo no puede estar vacio", "error");
            return false;
        }
        $('#btnCrearTipoEmpleado').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer registrar este tipo',
            function(){

                const form = document.getElementById('frmCapturaNuevoTipoEmpleado');
                const formData = new FormData(form);

                $.ajax({

                        type: 'POST',
                        url: baseurl + 'empleados/crearTipoEmpleado',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if (res) {

                                alertify.success('Nuevo Tipo Creado');


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

    $(document).on("click", "#btnCancelarNuevoTipoEmpleado", function () {
        $("#divFormNuevoTipoEmpleado").empty();
    });

    $(document).on("click", "bntNuevaCategoria", function () {
        $("#btnCrearTipoEmpleado").empty();
    });



    $(document).on("click", "#btnEditarTipoEmpleadoTbl", function( e ){
        e.preventDefault();
        var idtipo = $(this).data("id");

        $.post(baseurl + 'empleados/getTipo/' + idtipo, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (i, val) {

                var content = "";
                content += '<form enctype="multipart/form-data" id="frmCapturaEditarTipoEmpleado">';
                content += '<input value="'+ val.idTipoEmpleado +'" type="hidden" name="txtIdTipo">';
                content += '<div class="md-form">';
                content += '<input value="'+ val.tipoEmpleado +'" placeholder="Minimo 3 Letras" minlength="3" type="text" class="form-control" name="txtNombreTipoEmpleado" id="txtNombreTipoEmpleado">';
                content += '</div>';
                content += '</form>';

                $("#divEditarTipoEmpleado").append(content);
            });

        });

    });



    $("#btnEditarTipoEmpleado").click(function () {

        if ($("#txtNombreTipoEmpleado").val() == "") {
            swal("Error!", "El campo no puede estar vacio", "error");
            return false;
        }


        $('#btnEditarTipoEmpleado').attr('data-dismiss', "modal");

        alertify.confirm('Estas seguro?', 'De querer modificar este tipo',
            function(){

                const form = document.getElementById('frmCapturaEditarTipoEmpleado');
                const formData = new FormData(form);

                $.ajax({

                        type: 'POST',
                        url: baseurl + 'empleados/editarTipo',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if (res) {

                                alertify.success('Tipo modificado');

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

    $(document).on("click", "#btnCancelarEditarTipoEmpleado", function () {
        $("#divEditarTipoEmpleado").empty();
    });



    $(document).on("click", "#btnEliminarTipoEmpleadoTbl", function(  ) {

        var id = $(this).data('id');

        alertify.confirm('Estas seguro?', 'De querer borrar este tipo',
            function(){

                $.ajax({
                    type: "POST",
                    url: baseurl + 'empleados/borrarTipo',
                    dataType: 'json',
                    data: {id: id },
                    success: function (res) {
                        if (res) {
                            $("#fila"+id).remove();
                            alertify.success('Eliminado');
                        }

                    }
                });

            },
            function(){
                alertify.error('Cancelado')
            });

    });

});