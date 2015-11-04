<?php validation_errors();  ?> 
<?php if (isset($capturas)): ?>
	
	<table  class="table table-condensed">
		<tr>
			<thead>
				<td align="center"><b>Codigo</b></td>
				<td align="center"><b>Fecha Inicial</b></td>
				<td align="center"><b>Fecha Final</b></td>
				<td align="center"><b>Total Dias</b></td>
				<td align="center"><b>Periodo</b></td>
				<td align="center"><b>Accion</b></td>
			</thead>
		</tr>

	<?php $atributo_boton_eliminar = array('class' => 'btn btn-danger btn-sm fa fa-trash-o', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				 ?>
	<?php 	foreach ($capturas as $row): ?> 
		<tr>
			<tbody>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>
			<?php if (!$row->capturada): ?>
				<td align="center"><?php echo anchor('captura/delete/'.$row->token.'/'.$row->empleado_id.'/'.$row->qna_id,' ',$atributo_boton_eliminar);?></td>
			<?php else: ?>
				<td></td>
			<?php endif ?>
			</tbody>
		</tr>
	<?php 	endforeach; ?>
	</table>
<?php endif; ?>