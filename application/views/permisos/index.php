<h2 align="center">SELECCIONE ALGÚN EMPLEADO </h2>
<hr>

<div class="row offset-4">
    <?php $this->load->view('layouts/paginacion_view');?>
</div>

<table class="table table-bordered table-striped">
    <thead class="blue-grey lighten-4">
    <tr>

        <th class="text-center">
            NOMBRE
        </th>

        <th class="text-center">
            USUARIO
        </th>

        <th class="text-center">
            TIPO
        </th>


    </tr>

    </thead>
    <tbody>
    <?php if($users_data != FALSE): ?>


    <?php foreach($users_data as $user): ?>
        <tr>
            <td align="center"><?php echo $user->nombresEmpleado; ?></td>
            <td align="center"><?php echo $user->username; ?></td>
            <td align="center"><?php echo $user->tipoEmpleado;?></td>
            <td align="center"><a  title="Asignar" href="<?php echo base_url(); ?>permisos/asignar/<?php echo $user->idEmpleado; ?>"><i class="fa fa-user fa-3x red-text"></i></a></td>
        </tr>


    <?php endforeach; ?>


    </tbody>

</table>

<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Empleados</p>

<?php endif; ?>

