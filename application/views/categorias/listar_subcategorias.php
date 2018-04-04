<h2 align="center">SUBCATEGORIAS </h2>
<hr>


<!-- Button trigger modal -->
<button id="btnCrearCategoria" style="cursor: pointer;" type="button" class="btn btn-success" data-toggle="modal" data-target="#mCrearCategoria">
    <i class="fa fa-plus"></i>Crear Subategoria
</button>
<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mCrearCategoria" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4   class="modal-title font-weight-bold" id="productoModalLabel">Nueva Subcategoria</h4>
            </div>
            <div class="modal-body">
                <div id="formularioCrearCategoria">

                </div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarNuevaCategoria" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="bntNuevaCategoria" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="mEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Editar Subcategoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="formularioEditarCategoria"></div>
            </div>
            <div class="modal-footer">
                <button style="cursor: pointer;" type="button" class="btn btn-danger" id="btnCancelarEditarCategoria" data-dismiss="modal">Cancelar</button>
                <button style="cursor: pointer;" type="button" class="btn btn-success" id="btnEditarCategoria" data-dismiss="modal">Editar</button>
            </div>
        </div>
    </div>
</div>


<table class="table table-bordered table-striped listadoproductos">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            ID
        </th>
        <th class="text-center">
            CATEGORIA
        </th>

        <th class="text-center">
            SUBCATEGORIA
        </th>



    </tr>

    </thead>
    <tbody id="tbllistacategorias">
    <?php if($subcategorias_data != FALSE): ?>


    <?php foreach($subcategorias_data as $subcategoria): ?>
        <tr id="fila<?php echo $subcategoria->idSubcategoria;?>">
            <td align="center"><?php echo $subcategoria->idSubcategoria; ?></td>
            <td align="center"><?php echo $subcategoria->categoria; ?></td>
            <td align="center"><?php echo $subcategoria->nombre; ?></td>
            <td align="center"><a title="Borrar" ><i id="btnEliminarCategoria" data-id="<?php echo $subcategoria->idSubcategoria;?>"  class="fa fa-times fa-3x red-text" aria-hidden="true"></i></a></td>
            <td align="center"> <a data-toggle="modal" data-target="#mEditarCategoria"  title="Editar" href=""><i data-id="<?php echo $subcategoria->idSubcategoria;?>" id="btnEditarCategoriaTbl" class="fa fa-edit fa-3x" aria-hidden="true"></i></a>
            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Sub Categorias</p>

<?php endif; ?>



