<h2 align="center" id="fecha">Fecha: </h2>
<hr>
<div class="row">
    <div class="col-lg-3 jumbotron" id="categorias" align="center">
        <h2>Categorias</h2>
        <hr>
        <div>
            <?php foreach($categoria_data as $categoria): ?>
                <button type="button" style="cursor: pointer;" class="btn btn-amber btn-lg btn-block btnCategoriaOrden" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"><?php echo $categoria->categoria ?></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-9 jumbotron" id="menu" align="center">
        <h2>Ordenes</h2>
        <hr>
        <div id="contenedor_ordenes">

        </div>
    </div>
</div>

