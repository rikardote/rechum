<table class="table table-striped">
	<tr>
		<thead>
			<td>Num Empleado</td>
			<td>Nombre</td>
		</thead>
	</tr>
	<tr>
<?php foreach ($sortedObjectArray as $empleado): ?>
		<?php if ($empleado->conteo > 3 || in_array($empleado->incidencia_cod, $inc)):	?>
			<td><?=$empleado->num_empleado;?></td>	
			<td><?=nombre_completo($empleado->nombres,$empleado->apellido_pat,$empleado->apellido_mat)?></td>
		<?php endif ?>
	</tr>
<?php endforeach ?>
</table>
<hr>

