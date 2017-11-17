/**
 * Created by DELEON on 07-Nov-17.
 */

var baseurl = 'https://ordenes-app.herokuapp.com/';

var fecha = new Date;
var hoy = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();

$(document).ready(function() {

    //setInterval(
    //    $.post(baseurl + 'Orders/ordenes_categoria/' + hoy +'/'+1, function (data) {
    //    var result = JSON.parse(data);
    //    if(result){
    //        $.each(result, function (i, val) {
    //
    //            var content = "";
    //            content += '<p class="text-left detalle'+val.idDetalleOrden+'">Orden: '+val.idOrden+' - Mesa: '+val.noMesa+'</p>';
    //            content += '<table class="table table-striped table-bordered detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'">';
    //            content += '<tr class="detalle'+val.idDetalleOrden+'">';
    //            content += '<td class="btnProductoListo text-left detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'" data-id=' + val.idDetalleOrden +'>'+val.producto+'</td>';
    //            content += '<td class="text-center detalle'+val.idDetalleOrden+'" style="width: 5%" id="detalle'+val.idDetalleOrden+'">';
    //            content += '<i href="" data-id="'+val.idDetalleOrden+'" class="btnProductoListo fa fa-check"></i>';
    //            content += '</td class="detalle'+val.idDetalleOrden+'">';
    //            content += '</tr class="detalle'+val.idDetalleOrden+'">';
    //            content += '</table class="detalle'+val.idDetalleOrden+'">';
    //            $("#contenedor_ordenes").append(content);
    //        });
    //    }
    //}), 3000);

    $("h2#fecha").append(hoy);

    $(document).on("click", ".btnCategoriaOrden", function (e) {


        var id = $(this).data("id");
        var categoria = $(this).data('categoria');
        $(".cBar").remove()
        $(".cCocina").remove()

        if (categoria === "Bar"){
            $(".c"+'Cocina').remove();
        }
        if (categoria === "Cocina"){
            $(".c"+'Bar').remove();
        }

        console.log(id,categoria);
        $.post(baseurl + 'Orders/ordenes_categoria/' + hoy +'/'+id, function (data) {
            var result = JSON.parse(data);
            if(result){
                $.each(result, function (i, val) {

                    var content = "";
                    content += '<p class="text-left detalle'+val.idDetalleOrden+' c'+categoria+'">Orden: '+val.idOrden+' - Mesa: '+val.noMesa+'</p>';
                    content += '<table class="c'+categoria+' table table-striped table-bordered detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'">';
                    content += '<tr class="detalle'+val.idDetalleOrden+' c'+categoria+'">';
                    content += '<td class="c'+categoria+' btnProductoListo text-left detalle'+val.idDetalleOrden+'" id="detalle'+val.idDetalleOrden+'" data-id=' + val.idDetalleOrden +'>'+val.producto+'</td>';
                    content += '<td class="c'+categoria+' text-center detalle'+val.idDetalleOrden+'" style="width: 5%" id="detalle'+val.idDetalleOrden+'">';
                    content += '<i href="" data-id="'+val.idDetalleOrden+'" class="c'+categoria+' btnProductoListo fa fa-check"></i>';
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
        $.post(baseurl + 'DetalleOrden/updateDetalle/' + idDetalleOrden, function (data) {
            var result = JSON.parse(data);
            if(result){
                console.log(result);
            }
            $(".detalle"+idDetalleOrden).remove();
        });
    });


});



