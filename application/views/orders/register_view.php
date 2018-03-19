
<div class="row">
    <div  class="col-lg-6">
        <h6><strong>Seleccionar Mesero:</strong></h6>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($meseros_data as $mesero): ?>
                    <label style="cursor: pointer;" class="btn orange btn-sm accent-2 mesero" data-id="<?php echo $mesero->idEmpleado;?>" data-nombre="<?php echo $mesero->nombresEmpleado;?>">
                        <input type="checkbox" autocomplete="off"> <?php echo $mesero->nombresEmpleado ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron meseros registrados!</p>
        <?php endif; ?>
    </div>

    <div class="col-lg-6">
        <h6><strong>Seleccionar Mesa:</strong></h6>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($mesas_data as $mesa): ?>
                    <label style="cursor: pointer;" class="btn btn-danger btn-sm mesa" data-id="<?php echo $mesa->idMesa;?>" data-nombre="<?php echo $mesa->noMesa;?>" >
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
                <button style="cursor: pointer;" type="button" class="btn orange accent-2 btn-lg btn-block btnCategorias" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"><?php echo $categoria->categoria ?></button>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="col-lg-7 jumbotron" id="menu" align="center">

        <h3>Menú</h3>

            <span id="opsiguiente" title="Siguiente" style="float: right; cursor:pointer; " class="fa fa-chevron-circle-right fa-2x  "></span>
            <span  id="opanterior" title="Anterior" style="float: left; cursor:pointer; " class="fa fa-chevron-circle-left fa-2x"></span>

        <br>



        <hr>
        <div id="contenedor_productos">

        </div>
    </div>

    <div class="col-lg-3 jumbotron" id="orden" align="center">
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

