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
        <?php else: ?>
            <br><br><p class="bg-danger">No se encontraron Ordenes</p>

        <?php endif; ?>

        <div class="col-md-2">

            <?php if ($idmovimiento = movimiento($this->session->userdata('idempleado'))) :?>
            <label class="text-gray-dark text-lg-center">Monto de Apertura: <?php echo moneda($idmovimiento->montoAperturaT); ?></label>
                <span><button   data-idmovimiento="<?php echo $idmovimiento->idtemp; ?>" id="btnCerarCaja" data-idempleado="<?php echo $this->session->userdata('idempleado'); ?>" style="cursor: pointer;" class="btn btn-danger">Cerrar Caja</button></span>
            <?php else: ?>
                <span><button disabled>Cerrar Caja</button></span>
            <?php endif; ?>

        </div>
    </div>


<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="modalAperturaCaja" role="dialog" aria-labelledby="modalAperturaCaja" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Ingrese Monto Apertura Caja</h4>

            </div>
            <div class="offset-3 modal-body col-md-5">
                <input  data-empleado="<?php echo $this->session->userdata('idempleado'); ?>" id="txtRegistrarApertura" required  type="number" placeholder="Monto" class="input-group">
            </div>
            <div class="modal-footer">

                <button id="btnRegistrarMontoApertura" style="cursor: pointer;" type="button" class="btn btn-success" id="" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  myModal" data-backdrop="static" data-keyboard="false" id="modalCierreCaja" role="dialog" aria-labelledby="modalAperturaCaja" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title font-weight-bold" id="productoModalLabel">Su monto de cierre es de: </h4>

            </div>
            <div class="offset-3 modal-body col-md-5">
               <h1> <span  id="txtCierreCaja"  class="text-lg-center text-danger"></span></h1>
                 <span  id="txtCierreCaja"  class="text-info">(Total de ventas registradas en su turno)</span>
            </div>
            <div class="modal-footer">

                <button data-idmovimiento="<?php echo $idmovimiento->idtemp; ?>" data-empleado="<?php echo $this->session->userdata('idempleado'); ?>" id="btnConfirmaCierreCaja" style="cursor: pointer;" type="button" class="btn btn-success" id="" data-dismiss="modal">Registrar</button>
            </div>
        </div>
    </div>
</div>


