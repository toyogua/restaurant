<h2 align="center">VENTAS </h2>
<hr>


<?php if($mesas != FALSE): ?>
<div class="row">
    <div class="col-md-4 offset-1">

    <?php foreach($mesas as $mesa): ?>

        <button type="button" data-idmesa="<?php echo $mesa->idMesa; ?>" style="cursor: pointer;" class="btn btn-primary btnmesacobrar">Mesa: <?php echo $mesa->noMesa; ?></button>
        <div id="dvmesa<?php echo $mesa->idMesa; ?>" class="dvmesacobrar">

        </div>

    <?php endforeach; ?>
    </div>

    <div class="col-md-4">
        <span><button id="btnPagarOrden" style="cursor:pointer;" type="button" class="btn btn-primary">Pagar</button></span>
    </div>

</div>
<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Ordenes</p>

<?php endif; ?>

