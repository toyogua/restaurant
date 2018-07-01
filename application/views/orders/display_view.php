<h2 align="center" id="fecha">Fecha: </h2>
<hr>
<div class="row">
    <div class="col-lg-3 jumbotron" id="categorias" align="center">
        <h2>Categorias</h2>
        <hr>
        <div>
            <?php if ( $categoria_data != FALSE ): ?>
            <?php foreach($categoria_data as $categoria): ?>
                <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ordenes", "Cocina")): ?>
                <?php if ($categoria->categoria == "Comida"): ?>
                    <button type="button" style="cursor: pointer;" class="btn btn-amber btn-lg btn-block btnCategoriaOrden" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"> <?php echo $categoria->categoria ?></button>
                <?php endif;?>
                <?php endif; ?>

            <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ordenes", "Bebida")): ?>
                <?php if ( $categoria->categoria == "Bebida"): ?>
                        <button type="button" style="cursor: pointer;" class="btn btn-amber btn-lg btn-block btnCategoriaOrden" data-id="<?php echo $categoria->idCategoria;?>" data-categoria="<?php echo $categoria->categoria;?>"> <?php echo $categoria->categoria ?></button>
                <?php endif;?>
                <?php endif; ?>


            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-9 jumbotron" id="menu" align="center">
        <h2>Ordenes</h2>
        <hr>
        <div id="contenedor_ordenes">

        </div>
    </div>
</div>

