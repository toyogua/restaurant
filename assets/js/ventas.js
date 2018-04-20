$(document).ready(function() {

    $(document).on("click", ".btnmesacobrar", function () {

        $(".dvmesacobrar").empty();

        var idmesa = $(this).data('idmesa');

        $.ajax({
            type: "POST",
            url: baseurl + 'ventas/obtenerOrdenMesa',
            dataType: 'json',
            data: {idmesa: idmesa},
            success: function (res) {
                console.log(res);
                if (res) {
                    $.each(res, function (i, val) {
                    $("#dvmesa"+idmesa).append('<div class="input-group col-md-3">'+
                        '<span class="input-group-addon">'+
                        '<input checked="checked" class="checkproducto" value="'+val.producto+'" type="checkbox"'+
                        'aria-label="Radio button for following text input">'+
                        '</span>'+
                        '<label data-nombre="" data-id="Lunes" for="checkbox2"'+
                        'class="badge badge-pill purple btn btn-md">'+ val.producto +'</label>'+
                        '</div>');

                    });
                }
            }
        });

    });

    $(document).on("click", ".checkproducto", function () {

        console.log( $(this).val());

    });

    $(document).on("click", "#btnPagarOrden", function () {

        console.log("Boton presionado");

    });



});