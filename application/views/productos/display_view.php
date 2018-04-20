<h2 align="center">PRODUCTOS </h2>
<hr>


<!-- Button trigger modal -->
<button style="cursor: pointer;" type="button" class="btn btn-success btnNuevoProducto" data-toggle="modal" data-target="#modaProducto">
    <i class="fa fa-plus"></i>Nuevo Producto
</button>
<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="modaProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog moda-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4   class="modal-title font-weight-bold" id="productoModalLabel">Nuevo Producto</h4>
<!--                <button style="cursor: pointer;" type="button" class="close" data-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <div id="formularionuevoproducto" class="contenedorProductoRegistro">

                </div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarRegistroProducto" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnRegistrarProducto" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
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
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarProducto" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnMEditProducto" data-dismiss="modal">Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalIngrediente" tabindex="-1" role="dialog" aria-labelledby="modalIngredienteLlb" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4  class="modal-title font-weight-bold" id="productoModalLabel">Selecciona Ingrediente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center col-md-11">
                    <label>Ingrediente</label>
                    <input type="text">
                    <label>Cantidad</label>
                    <input type="number">
                </div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="" data-dismiss="modal">Agregar</button>
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
            SUBCATEGORIA
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
            <td align="center"><?php echo $producto->categoria; ?></td>
            <td align="center"><?php echo $producto->nombre;?></td>
            <td align="center"><img class="img-fluid" style="border-radius: 150px; height: 50px; width: 50px;" src=".<?php echo $producto->imghx;?>"></td>
            <td align="center"><a title="Borrar" ><i id="btnEliminarProducto" data-id="<?php echo $producto->idProducto;?>" class="fa fa-times fa-3x red-text" aria-hidden="true"></i></a></td>
            <td align="center"> <a  data-id="<?php echo $producto->idProducto; ?>" data-toggle="modal" data-target="#modalProducto"  title="Editar" href=""><i id="btnEditarProductoTbl" data-id="<?php echo $producto->idProducto;?>" class="fa fa-edit fa-3x btnEditarProducto" aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Productos</p>

<?php endif; ?>



