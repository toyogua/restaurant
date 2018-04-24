
var baseurl = 'http://localhost/restaurant/';

var fecha = new Date;
var hoy = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
var f=new Date();
var idCategoria = 0;
var categoria = '';

$(document).ready(function() {

    //console.log(hora);
    if( window.location.href === baseurl + 'orders/display'){
        function getOrdenesAutomaticas(){
            $("#contenedor_ordenes").empty();
            if(categoria != ''){
                $(".cBar").remove();
                $(".cCocina").remove();

                if (categoria === "Bar"){
                    $(".c"+'Cocina').remove();
                }
                if (categoria === "Cocina"){
                    $(".c"+'Bar').remove();
                }

                $.post(baseurl + 'Orders/ordenes_categoria/' + hoy +'/'+idCategoria, function (data) {
                    var result = JSON.parse(data);
                    if(result){
                        $.each(result, function (i, val) {
                            var content = "";
                            content += '<p class="text-left detalle'+val.idDetalleOrden+' c'+categoria+'">Orden: '+val.idOrden+' - Mesa: '+val.noMesa  +' Alias: '+ val.aliasMesa +'</p>';
                            content += '<table class="c'+categoria+' table table-striped table-bordered detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'">';
                            content += '<tr class="detalle'+val.idDetalleOrden+' c'+categoria+'">';
                            content += '<td class="c'+categoria+' btnProductoListo text-left detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'" data-id=' + val.idDetalleOrden +'>'+val.producto+'</td>';
                            content += '<td class="c'+categoria +' text-danger">'+ val.notaDetalleOrden +'</td>';
                            content += '<td class="c'+categoria+' text-center detalle'+val.idDetalleOrden+'" style="width: 5%" id="detalle'+val.idDetalleOrden+'">';
                            content += '<i style="cursor: pointer;" href="" data-mesa="'+ val.idMesa+'" data-id="'+val.idDetalleOrden+'" class="c'+categoria+' btnProductoListo fa fa-check fa-4x"></i>';

                            content += '</td class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                            content += '</tr class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                            content += '</table class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                            $("#contenedor_ordenes").append(content);
                        });
                    }else{
                        var content = "";
                        content += '<p class="text-left c'+categoria+'">No se encontraron ordenes en la categoria '+categoria+'</p>';
                        $("#contenedor_ordenes").append(content);
                    }
                });
            }
        }console.log('recargado');
    }

    setInterval(getOrdenesAutomaticas, 10000);

    $("h2#fecha").append(hoy);

    $(document).on("click", ".btnCategoriaOrden", function () {

        $("#contenedor_ordenes").empty();
        var id = $(this).data("id");
        idCategoria = id;

        var categoriaDinamica = $(this).data('categoria');
        categoria = categoriaDinamica;

        $(".cBar").remove();
        $(".cCocina").remove();

        if (categoria === "Bar"){
            $(".c"+'Cocina').remove();
        }
        if (categoria === "Cocina"){
            $(".c"+'Bar').remove();
        }

        console.log(id,categoria);
        $.post(baseurl + 'Orders/ordenes_categoria/' + hoy +'/'+idCategoria, function (data) {
            var result = JSON.parse(data);
            if(result){
                $.each(result, function (i, val) {

                    var content = "";
                    content += '<p class="text-left detalle'+val.idDetalleOrden+' c'+categoria+'">Orden: '+val.idOrden+' - Mesa: '+val.noMesa  +' Alias: '+ val.aliasMesa +'</p>';
                    content += '<table class="c'+categoria+' table table-striped table-bordered detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'">';
                    content += '<tr class="detalle'+val.idDetalleOrden+' c'+categoria+'">';
                    content += '<td class="c'+categoria+' btnProductoListo text-left detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'" data-id=' + val.idDetalleOrden +'>'+val.producto+'</td>';
                    content += '<td class="c'+categoria +' text-danger">'+ val.notaDetalleOrden +'</td>';
                    content += '<td class="c'+categoria+' text-center detalle'+val.idDetalleOrden+'" style="width: 5%" id="detalle'+val.idDetalleOrden+'">';
                    content += '<i style="cursor: pointer;" href="" data-mesa="'+ val.idMesa +'" data-id="'+val.idDetalleOrden+'" class="c'+categoria+' btnProductoListo fa fa-check fa-4x"></i>';

                    content += '</td class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                    content += '</tr class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                    content += '</table class="c'+categoria+' detalle'+val.idDetalleOrden+'">';
                    $("#contenedor_ordenes").append(content);
                });
            }else{
                var content = "";
                content += '<p class="text-left c'+categoria+'">No se encontraron ordenes en la categoria '+categoria+'</p>';
                $("#contenedor_ordenes").append(content);
            }
        });
    });

    $(document).on("click", ".btnProductoListo", function (e) {
        var idDetalleOrden = $(this).data("id");
        var idmesa = $(this).data("mesa");
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

                if (isConfirm){

                    $.ajax({
                        type: "POST",
                        url: baseurl + 'DetalleOrden/updateDetalle',
                        dataType: 'json',
                        data: {idDetalleOrden: idDetalleOrden, idmesa: idmesa},
                        success: function (res) {
                            console.log(res);
                            if (res) {

                                alertify.success('Actualizada');
                            }
                            $(".detalle"+idDetalleOrden).remove();

                        }
                    });

                    swal("Procesando!", "La orden fue despachada.", "success");
                }

            });

    });

    //detectar el cambio en el menu principal
    var cambio = false;
    $('.navbar-nav  li a').each(function(index) {
        if(this.href.trim() == window.location){
            $(this).parent().addClass("btn btn-info btn-sm");
            cambio = true;
        }
    });
    if(!cambio){
        $('.navbar-nav  li:first').addClass("btn btn-info btn-sm");
    }
});



