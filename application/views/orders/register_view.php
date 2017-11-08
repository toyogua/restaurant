
    <div class="row">
        <div class="md-form col-lg-3">
<!--            <i class="fa fa-user prefix grey-text"></i>-->
            <input type="text"  id="mesero" class="mesero form-control text-center" placeholder="Buscar Mesero">
            <div  id="cargamesero" >
            </div>
        </div>

        <div class="md-form col-lg-3">
<!--            <i class="fa fa-circle-thin prefix grey-text"></i>-->
            <input type="text" id="mesa" class="mesa form-control" placeholder="Buscar Mesa">
            <div id="cargamesas" >
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-lg-3 jumbotron" id="categorias" align="center">
            <h2>Categorias</h2>
            <hr>
            <div>
                <?php foreach($categoria_data as $categoria): ?>
                    <button type="button" class="btn btn-amber btn-lg btn-block btnCategorias" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"><?php echo $categoria->categoria ?></button>
                <?php endforeach; ?>
            </div>

        </div>

        <div class="col-lg-3 jumbotron" id="menu" align="center">
            <h2>Menú</h2>
            <hr>
            <div id="contenedor_productos">

            </div>
        </div>

        <div class="col-lg-3 jumbotron" align="center">
            <h2>Descripción</h2>
            <hr>
            <div id="contenedor_des_producto"></div><br>
            <div id="contenedor_boton"></div>
        </div>

        <div class="col-lg-3 jumbotron" id="orden" align="center">
            <h2>Orden</h2>
            <hr>
            <div id="contenedor_total"></div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td style="width: 5%">#</td>
                    <td>Producto</td>
                </tr>
                </thead>

                <tbody id="tblRegistros">

                </tbody>
            </table>

            <div id="contenedor_productos_orden"></div>
            <br>
            <div id="btn_ordenar"></div>
        </div>
