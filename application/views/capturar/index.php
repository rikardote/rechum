<div class="col-md-6">
	<?php $this->load->view('capturar/search'); ?>
</div>

<?php if (isset($empleado)): ?>
			
	<table  class="table">
		<tr>
			<thead>	

			<td>Numero de Empleado</td>
			<td>Nombre</td>
			<td>Adscripcion</td>
			<td align="center">Qnas</td>
			</thead>	

		</tr>
		<tr>		
<?php	foreach ($empleado as $empleado): ?>
			<?php 
				$atributo_boton_modificar = array('class' => 'btn btn-info round glyphicon glyphicon-pencil');
				
			 ?>
				<?php
					if($empleado->activo) {
						$atributo_boton_activate = array('class' => 'btn btn-success round glyphicon glyphicon-off'); 
					} else {
						$atributo_boton_activate = array('class' => 'btn btn-default round glyphicon glyphicon-off'); 
					}
				?>

				<td><?php echo anchor('captura/show/'.$empleado->id, $empleado->num_empleado);?></td>
				<td><?php echo anchor('captura/show/'.$empleado->id, nombre_completo($empleado->nombres,$empleado->apellido_pat,$empleado->apellido_mat)) ?></td>
				<td><?php echo $empleado->adscripcion;?></td>
				<td align="center">
					<?php	foreach ($qnas_activas as $qna): ?>
					<?php 		echo anchor('captura/show/'.$empleado->id.'/'.$qna->id,$qna->qna_mes,$atributo_boton_modificar);?> 
					<?php	endforeach;?>
				</td>

					
		</tr>

		
<?php 	endforeach;?>
<?php endif ?>
</table>

<?php if (isset($noencontrado)): ?>
	<div align="center" class="col-xs-12 alert alert-warning">
		<?=$noencontrado;?>
	</div>	
<?php endif ?>

</div>	

	

	

