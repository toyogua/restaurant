<h2 align="center">PRODUCTOS </h2>
<hr>


<!-- Button trigger modal -->
<button type="button" class="btn btn-success btnNuevoProducto" data-toggle="modal" data-target="#modaProducto">
    <i class="fa fa-plus"></i>Nuevo Producto
</button>
<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="modaProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="formularionuevoproducto" class="contenedorProductoRegistro">

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
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Editar Producto</h4>
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

<table class="table table-bordered table-striped listadoproductos">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            NOMBRE
        </th>

        <th class="text-center">
            PRECIO
        </th>

        <th class="text-center">
            COSTO
        </th>


        <th class="text-center">
            EXISTENCIA
        </th>
        <th class="text-center">
            CATEGORIA
        </th>

        <th class="text-center">
            IMAGEN
        </th>
        <th class="text-center">
            ELIMINAR
        </th>

        <th class="text-center">
            EDITAR
        </th>

    </tr>

    </thead>
    <tbody id="mostralistadoproductos">
    <?php if($productos_data != FALSE): ?>


    <?php foreach($productos_data as $producto): ?>
        <tr id="fila<?php echo $producto->idProducto;?>">
            <td align="center"><?php echo $producto->producto; ?></td>
            <td align="center"><?php echo $producto->precioProducto; ?></td>
            <td align="center"><?php echo $producto->costoProducto;?></td>
            <td align="center"><?php echo $producto->cantProducto; ?></td>
            <td align="center"><?php echo $producto->categoria;?></td>
            <td align="center"><img class="img-fluid" style="border-radius: 150px; height: 50px; width: 50px;" src=".<?php echo $producto->imghx;?>"></td>
            <td align="center"><a class="btnEliminarProducto" title="Borrar"  data-id="<?php echo $producto->idProducto;?>"><i class="fa fa-times fa-3x red-text" aria-hidden="true"></i></a></td>
            <td align="center"> <a data-toggle="modal" data-target="#modalProducto" class="btnEditarProducto" title="Editar" href="" data-id="<?php echo $producto->idProducto;?>"><i class="fa fa-edit fa-3x" aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Productos</p>

<?php endif; ?>



