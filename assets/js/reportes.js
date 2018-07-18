var vInt = 0;

$(document).ready(function() {

//summary
//param-name<vInt> = Contiene el id de la opocion seleccionada (hoy, esta semana, mes ...)
$(".vInt").click( function () {
    vInt = $(this).data("id");
    console.log(vInt);
});

//summary
//param-name<rdOpcion> = variable que contiene la opcion del radio button (intervalo fijo/rango perosonalizado)
$("#btnReporteVentas").click( function () {

   var rdOpcion = $('input:radio[name=rdIntervalo]:checked').val();
    // $.ajax({
    //     type: "POST",
    //     url: baseurl + 'reportes/listar',
    //     dataType: 'json',
    //     data: {intervalo: vInt, radio: rdOpcion},
    //     success: function (res) {
    //
    //
    //     }
    // });
    $.post(baseurl+"reportes/listar", {intervalo: vInt, radio:rdOpcion}, function(data, textStatus, xhr) {
        //console.log(data);
    });

    //window.location.href = baseurl+"reportes/listar";
});

$("#formReVentas").submit( function () {
    $.ajax({
        type: 'POST',
        url: $("#formReVentas").attr('action'),
        data: $("#formReVentas").serialize()

    });
});

});