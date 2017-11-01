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
                <button type="button" class="btn btn-lime btn-lg btn-block" id="cat<?php echo $categoria->idCategoria;?>"><?php echo $categoria->categoria ?></button>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-4 jumbotron" id="menu" align="center">
            <h2>Menú</h2>
            <hr>
        </div>

        <div class="col-lg-4 jumbotron" id="orden" align="center">
            <h2>Orden</h2>
            <hr>
        </div>

    </div>
</div>
</body>
</html>
