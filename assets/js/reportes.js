var vInt = 0;

$(document).ready(function() {

    $("#formReVentas").submit( function () {
    $.ajax({
        type: 'POST',
        url: $("#formReVentas").attr('action'),
        data: $("#formReVentas").serialize()

    });
});

});