<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div class="container">
    <div class="row">

        <div class="col-lg-4 jumbotron" id="categorias" align="center">
            <h2>Categorias</h2>
            <hr>
            <?php foreach($categoria_data as $categoria): ?>
                <button type="button" class="btn btn-amber btn-lg btn-block btnCategorias" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"><?php echo $categoria->categoria ?></button>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-4 jumbotron" id="menu" align="center">
            <h2>Menú</h2>
            <hr>
            <div id="contenedor_productos">

            </div>
        </div>

        <div class="col-lg-4 jumbotron" id="orden" align="center">
            <h2>Orden</h2>
            <hr>
        </div>

    </div>
</div>
</body>
</html>
