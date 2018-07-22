

	<h2 align="center">REPORTES <?php print_r( $titulo .' '.$fInicial .'  '. $fFinal  ); ?> </h2>
	<hr>

	<?php if ( $total!= null || $total >0): ?>
		<div class="col-md-4 offset-10">
			<label class="btn btn-info">Totales: Q <?php print_r($total)?></label>
		</div>
	<?php endif; ?>
	<table class="table table-bordered table-striped">
		<thead class="blue-grey lighten-4">
		<tr>

			<th class="text-center">
				FECHA
			</th>

			<th class="text-center">
				TOTAL
			</th>


		</tr>

		</thead>
		<tbody>
        <?php if(isset($ventas)): ?>


		<?php foreach($ventas as $venta): ?>
				<tr id="fila<?php echo $venta->idventa; ?>" >
					<td align="center"><?php echo $venta->fecha; ?></td>
				<td align="center"><?php echo $venta->total; ?></td>

			</tr>


		<?php endforeach; ?>


		</tbody>

	</table>

	<?php else: ?>
		<br><br><p class="bg-danger">No se encontraron Ventas</p>

	<?php endif; ?>



