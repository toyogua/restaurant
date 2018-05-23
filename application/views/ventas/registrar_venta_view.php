<h2 align="center">VENTAS </h2>
<hr>


<?php if($mesas != FALSE): ?>
    <div class="row">
        <div class="col-md-4 offset-1">

            <?php foreach($mesas as $mesa): ?>

                <?php $res =obtenerTotales($mesa->idMesa ); ?>

                <button type="button" data-idmesa="<?php echo $mesa->idMesa; ?>" style="cursor: pointer;" class="btn btn-primary btnmesacobrar">Mesa: <?php echo $mesa->noMesa; ?></button>
                <div id="dvmesa<?php echo $mesa->idMesa; ?>" class="dvmesacobrar">

                </div>
            <div><label id="lbltotalmesa<?php echo $mesa->idMesa; ?>" class="badge badge-pill purple">TOTAL EN ESTA MESA: Q: <?php echo $res; ?></label></div>

            <?php endforeach; ?>
        </div>

        <div class="col-md-2">
            <span><button data-empleado="<?php echo $this->session->userdata("idempleado"); ?>" id="btnPagarOrden" style="cursor:pointer;" type="button" class="btn btn-primary">Pagar</button></span>
        </div>
        <div class="col-md-1">
            <span><label id="lbltotalventa" class="font-weight-bold text-xl"></label></span>
        </div>

    </div>
<?php else: ?>
    <br><br><p class="bg-danger">No se encontraron Ordenes</p>

<?php endif; ?>

