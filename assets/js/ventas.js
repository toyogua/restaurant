var apagar = {
    listos: []
};

var mesaorden = 0;
var total = 0;
//variable para saber cuantos productos por orden y mesa existen
var enordenhay = 0;
//variable para saber la cantidad de productos que se han insertado en la tabla ventas
var controlinsertados = 0;


$(document).ready(function() {

    $(document).on("click", ".btnmesacobrar", function () {
        total = 0;
        
        $(".dvmesacobrar").empty();

        var idmesa = $(this).data('idmesa');
        mesaorden = idmesa;

        $.ajax({
            type: "POST",
            url: baseurl + 'ventas/obtenerOrdenMesa',
            dataType: 'json',
            data: {idmesa: idmesa},
            success: function (res) {


                if (res) {
                    var cuentaproductos = 0;
                    cuentaproductos = res.length;
                    //llamado a la funcion
                    controlproductos(cuentaproductos);

                    $.each(res, function (i, val) {
                        var subtotal = 0;
                        subtotal = parseInt(val.cantDetalleOrden) * parseInt(val.precioProducto);
                        
                        suma(subtotal);

                    $("#dvmesa"+idmesa).append('<div id="dv'+val.idProducto+'" class="col-md-11">'+

                        '<label id="lbl'+ val.idProducto +'"  style="font-size: 15px;" class="input-group">'+

                        '<input style="transform: scale(2.0); margin-right: 10px;" id="producto" data-precio="'+val.precioProducto+'" data-cantidad="'+val.cantDetalleOrden+'" checked="checked" class="form-check checkproducto" value="'+val.idProducto+'" type="checkbox"'+
                        'aria-label="Radio button for following text input">'  + val.producto +'  - Cantidad: '+val.cantDetalleOrden+' - Subtotal: '+subtotal+''+
                        
                        '</label>'+

                        '</div>');

                    });
                }
                else{
                    $("#dvmesa"+idmesa).append('<div><label class="text-danger">No hay orden para esta mesa</label></div>')
                }
            }
        });
    });

    //funcion que toma los productos que se encuentran en cada orden en cada mesa
    function controlproductos(cuentaproductos) {
        enordenhay = cuentaproductos;
        console.log(enordenhay);
    }

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
                controlinsertados = controlinsertados + apagar.listos.length;
                console.log(controlinsertados);
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
                });

                apagar.listos=[];

                if( enordenhay === controlinsertados){
                    console.log("Listo ya se acabo");
                    $.ajax({
                        type: "POST",
                        url: baseurl + 'Ventas/marcarComoPagada',
                        dataType: 'json',
                        data: {idmesa: mesaorden},
                        success: function (res) {
                            if (res) {

                                alertify.success('Venta Procesada');
                                setInterval(function() {
                                    cache_clear()
                                }, 1000);
                            }

                        }
                    });
                }else{
                    console.log("Siga trabajando...");
                }

            },
            function(){
                alertify.error('Cancelado')
            });
            
           
        

        
    });



});