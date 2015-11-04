<table class="table">
<tr>
			<td>empleado</td>
			<td>incidencia</td>
		</tr>
<?php foreach ($sin_derecho as $empleado): ?>
	
		
		<tr>
		<td><?php echo  $empleado->empleado_id; ?></td>
		<td><?php echo  $empleado->incidencia_cod; ?></td>
		</tr>
	
<?php endforeach ?>
</table>