/**
 * Created by DELEON on 01-Nov-17.
 */

var baseurl = 'http://localhost/restaurant/';

(function(){


    $("body").on("click", ".btnCategorias", function( e ){
        e.preventDefault();//para que no recargue la pagina, no redirecciona con el link


        //nombre tomado del data-nombre
        var id           = $(this).data("id");
        var categoria    = $(this).data('categoria');
        console.log(id);
        console.log(categoria);

        $.post(baseurl + 'Products/obtener_productos_categoria/' + id, function (data) {

            var result = JSON.parse(data);

            console.log(result);

            $.each(result, function (i, val) {

                var content = "";
                content += '<button type="button" class="btn btn-yellow btn-lg btn-block">' + val.producto +'</button>';

                $("#contenedor_productos").append(content);

            });
        });

    });

})();



