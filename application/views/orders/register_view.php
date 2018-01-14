
<div class="row">
    <div class="col-lg-6">
        <h4><strong>Seleccionar Mesero:</strong></h4>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($meseros_data as $mesero): ?>
                    <label class="btn btn-primary mesero" data-id="<?php echo $mesero->idEmpleado;?>" data-nombre="<?php echo $mesero->nombresEmpleado;?>">
                        <input type="checkbox" autocomplete="off"> <?php echo $mesero->nombresEmpleado ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron meseros registrados!</p>
        <?php endif; ?>
    </div><br>

    <div class="col-lg-6">
        <h4><strong>Seleccionar Mesa:</strong></h4>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($mesas_data as $mesa): ?>
                    <label class="btn btn-danger mesa" data-id="<?php echo $mesa->idMesa;?>" data-nombre="<?php echo $mesa->noMesa;?>" >
                        <input type="checkbox" autocomplete="off"> <?php echo $mesa->noMesa ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron mesas registrados!</p>
        <?php endif; ?>
    </div>
</div><br>



<div class="row">

    <div class="col-lg-2 jumbotron" id="categorias" align="center">
        <h2>Categorias</h2>
        <hr>
        <div>
            <?php foreach($categoria_data as $categoria): ?>
                <button type="button" class="btn btn-amber btn-lg btn-block btnCategorias" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"><?php echo $categoria->categoria ?></button>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="col-lg-6 jumbotron" id="menu" align="center">
        <h2>Menú</h2>
        <hr>
        <div id="contenedor_productos">

        </div>
    </div>

    <div class="col-lg-4 jumbotron" id="orden" align="center">
        <h2>Orden</h2>
        <hr>
        <div id="contenedor_total"></div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td style="width: 5%">Cant</td>
                <td>Producto</td>
                <td>Notas</td>
            </tr>
            </thead>

            <tbody id="tblRegistros">

            </tbody>
        </table>

        <div id="contenedor_productos_orden"></div>
        <br>
        <div id="btn_ordenar"></div>
    </div>
</div>