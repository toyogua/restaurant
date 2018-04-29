

<input id="idempleado" type="hidden" value="<?php echo $idempleado; ?>">
<div class="col-md-4">
<h3 class="list-group text-center">Órdenes</h3>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><input class="acctodos" data-id="Ordenes" type="checkbox" value="">&nbsp;Todos</li>
            <?php if ($acciones_ordenes != FALSE): ?>
            <?php foreach($acciones_ordenes as $a_ordenes): ?>
            <li class="list-group-item"><input data-modulo="<?php echo $a_ordenes->id_modulo; ?>" value="<?php echo $a_ordenes->accion; ?>" class="<?php echo $a_ordenes->id_modulo; ?>" type="checkbox">&nbsp;<?php echo $a_ordenes->accion; ?> </li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<hr>
<div class="col-md-4">
<h3 class="list-group text-center">Empleados</h3>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><input class="acctodos" data-id="Empleados" type="checkbox">&nbsp;Todos</li>
            <?php if ($acciones_empleados != FALSE): ?>
            <?php foreach($acciones_empleados as $a_empleados): ?>
                <li class="list-group-item"><input data-modulo="<?php echo $a_empleados->id_modulo; ?>" value="<?php echo $a_empleados->accion; ?>" class="<?php echo $a_empleados->id_modulo; ?>" type="checkbox">&nbsp;<?php echo $a_empleados->accion; ?> </li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

<hr>

<div class="col-md-4">
<h3 class="list-group text-center">Mesas</h3>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><input class="acctodos" data-id="Mesas" type="checkbox">&nbsp;&nbsp;Todos</li>
            <?php if ($acciones_mesas != FALSE): ?>
                <?php foreach($acciones_mesas as $a_mesas): ?>
                    <li class="list-group-item"><input data-modulo="<?php echo $a_mesas->id_modulo; ?>" value="<?php echo $a_mesas->accion; ?>" class="<?php echo $a_mesas->id_modulo; ?>" type="checkbox">&nbsp;<?php echo $a_mesas->accion; ?> </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<hr>
<div class="col-md-4">
<h3 class="list-group text-center">Ventas</h3>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><input class="acctodos" data-id="Ventas" type="checkbox">&nbsp;&nbsp;Todos</li>
            <?php if ($acciones_ventas != FALSE): ?>
                <?php foreach($acciones_ventas as $a_ventas): ?>
                    <li class="list-group-item"><input data-modulo="<?php echo $a_ventas->id_modulo; ?>" value="<?php echo $a_ventas->accion; ?>" class="<?php echo $a_ventas->id_modulo; ?>" type="checkbox">&nbsp;<?php echo $a_ventas->accion; ?> </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

<button id="btnAsignarPermisos" style="cursor: pointer;" class="btn btn-primary">Asignar </button>
