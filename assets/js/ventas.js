var apagar = {
    listos: []
};

var total = 0;

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
                        var subtotal = 0;
                        subtotal = parseInt(val.cantDetalleOrden) * parseInt(val.precioProducto);
                        
                        suma(subtotal);

                    $("#dvmesa"+idmesa).append('<div id="dv'+val.idProducto+'" class="input-group col-md-3">'+
                        '<span id="sp'+val.idProducto+'" class="input-group-addon">'+
                        '<input data-precio="'+val.precioProducto+'" data-cantidad="'+val.cantDetalleOrden+'" checked="checked" class="checkproducto" value="'+val.idProducto+'" type="checkbox"'+
                        'aria-label="Radio button for following text input">'+
                        '</span>'+
                        '<label id="lbl'+ val.idProducto +'" '+
                        'class="badge badge-pill purple btn btn-md">'+ val.producto +'  - Cantidad:'+val.cantDetalleOrden+' - Subtotal:'+subtotal+'</label>'+
                        '</div>');

                    });
                }
            }
        });
    });

    function suma(subtotal)
    {
        total = total + subtotal;
        $("#lbltotalventa").text("TOTAL: Q "+total);
    }

    //cuando se elije algun checkbox suma o resta
    $(document).on("change", "input:checkbox", function () {
        var sub = 0;
        if( $(this).is(':checked') ) {
            // Hacer algo si el checkbox ha sido seleccionado
           var cantidad = $(this).data("cantidad");
           sub = parseInt(cantidad) * parseInt($(this).data("precio")); 
           total = total + sub;
           $("#lbltotalventa").text("TOTAL: Q "+total);
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            var cantidad = $(this).data("cantidad");
            sub = parseInt(cantidad) * parseInt($(this).data("precio"));
            total = total - sub;
            $("#lbltotalventa").text("TOTAL: Q "+total);
        }
    });

    //insertar en la tabla de ventas
    $(document).on("click", "#btnPagarOrden", function () {

        var idempleado = $(this).data("empleado");
        alertify.confirm('Estas seguro?', 'Esto no se puede deshacer',
            function(){
                
                $("input:checkbox:checked").each(   
                    function() {
                        apagar.listos.push({
                            "idproducto": $(this).val()
        
                        });
                    }
                );
                
                var productosJSON = JSON.stringify(apagar.listos);
            
                    $.ajax({
                        type: "POST",
                        url: baseurl + 'Ventas/pagarProductos',
                        dataType: 'json',
                        data: {productos: productosJSON, idempleado:idempleado, total:total},
                        success: function (res) {
                            if (res) {

                                alertify.success('Venta Procesada');
                            }

                        }
                    });
                setInterval(function() {
                    //cache_clear()
                }, 1000);

                total = 0;
                
                $("#lbltotalventa").text("TOTAL: Q "+total);

                $.each(apagar.listos, function(i, val){
                    console.log(val);
                    $("input:checkbox:checked").remove();
                    $("#lbl"+val.idproducto).remove();
                    $("#sp"+val.idproducto).remove();
                });

                apagar.listos=[];

            },
            function(){
                alertify.error('Cancelado')
            });
            
           
        

        
    });



});