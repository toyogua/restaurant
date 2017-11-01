<div class="offset-1 col-10 col-lg-10">
    <br><div><h1 align="center" class="text-transparent">LISTADO DE USUARIOS</h1></div>

    <div>
        <!---->
<!--        <br><div class="row col-10 col-lg-10">-->
<!--            <div class="col-8 col-lg-8"><input type="text" class="form-control" placeholder="Buscar bus"></div>-->
<!--            <div class="col-2 col-lg-2"><button type="submit" class="btn btn-primary">Buscar</button></div>-->
<!--        </div>-->

        <!--        inicia div para recuadro lado derecho crear pago de bus-->
        <div class="col-xs-3 pull-right">

            <ul class="list-group">


                <li class="list-group-item"><a href="<?php echo base_url();?>users/register">Crear Usuario</a></li>

            </ul>
        </div> <!--fin recuadro derecho crear pago de bus-->

        <br><div><br>
            <table class="table table-striped table table-hover">
                <tr>


                    <th>
                        <h5 align="center">Nombres</h5>
                    </th>

                    <th>
                        <h5 align="center">Apellidos</h5>
                    </th>

                    <th>
                        <h5 align="center">Nombre de Usuario</h5>
                    </th>

                    <th>
                        <h5 align="center">Correo Electrónico</h5>
                    </th>

                </tr>
                </thead>
                <?php
                if(isset($users_data)){
                    foreach ($users_data as $users) { ?>
                        <tr class="list-group-item-info">
                            <td align="center"><?php echo $users->nombres; ?></td>
                            <td align="center"><?php echo $users->apellidos; ?></td>
                            <td align="center"><?php echo $users->username; ?></td>
                            <td align="center"><?php echo $users->email; ?></td>
                            <td ><a align="center" class="fa fa-times red-text" aria-hidden="true" title="Eliminar" href="<?php echo base_url(); ?>users/delete/<?php echo $users->id; ?>"><span class="glyphicon glyphicon-remove"></span> </a></td>
                            <td ><a align="center" class="fa fa-pencil-square-o" TITLE="Editar" href="<?php echo base_url(); ?>users/edit/<?php echo $users->id; ?>"><span class="glyphicon glyphicon-edit"></span> </a></td>
                        </tr>
                    <?php }} ?>
            </table>
        </div>
    </div>
</div>
