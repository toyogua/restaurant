<h2 align="center">PRODUCTOS </h2>
<hr>

<?php $attributes = array('id' => 'display_form', 'class' => 'form_horizontal');?>
<?php echo form_open('Products/display', $attributes);?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success btnNuevoProducto" data-toggle="modal" data-target="#modaProducto">
    <i class="fa fa-plus"></i>Nuevo Producto
</button>
<div class="modal fade  myModal" id="modaProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="contenedorProductoRegistro">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancelarRegistroProducto" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnRegistrarProducto" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Editar Ingrediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="contenedor_editar_producto"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancelarEditarProducto" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEditProducto" data-dismiss="modal">Editar</button>
            </div>
        </div>
    </div>
</div>



<?php if(isset($productos_data)): ?>
 <?php $contador = 0; ?>

<table class="table table-bordered table-striped table-responsive">

    <!--Table head-->
    <thead>
    <tr>
        <th scope="row"><b>#</b></th>
        <th class="th-lg"><b>Producto</b></th>
        <th class="th-lg"><b>Descripción</b></th>
        <th class="th-lg"><b>Costo</b></th>
        <th class="th-lg"><b>Precio</b></th>
        <th class="th-lg"><b>Cantidad</b></th>
    </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
    <?php foreach($productos_data as $producto): ?>
        <?php $contador = $contador + 1; ?>
        <tr id="fila<?php echo $producto->idProducto;?>">
            <?php  echo "<td>" . $contador ."</td>"; ?>
            <?php  echo "<td style='width: 25%;'>" . $producto->producto ."</td>"; ?>
            <?php  echo "<td style='width: 30%;'>" . $producto->descripcionProducto ."</td>"; ?>
            <?php  echo "<td style='width: 15%' align='right'>" . $producto->costoProducto ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='right'>Q " . $producto->precioProducto ."</td>"; ?>
            <?php  echo "<td style='width: 10%' align='right'>" . $producto->cantProducto ."</td>"; ?>

            <td align="center" style='width: 5%'><a class="btnEliminarProducto" title="Borrar" href="" data-nombre="<?php echo $producto->producto;?>" data-id="<?php echo $producto->idProducto;?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
            <td align="center" style='width: 5%'><a data-toggle="modal" data-target="#modalProducto" class="btnEditarProducto" title="Editar" href="" data-id="<?php echo $producto->idProducto;?>"><i class="fa fa-edit" aria-hidden="true"></i></a></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table><br>

</div>
<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Productos</p>
<?php endif; ?>

<?php form_close();?>


