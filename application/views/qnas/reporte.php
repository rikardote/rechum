
<?php if (isset($reporte)): ?>

	<table class="table table-condensed table-hover ">
		<tr>
			<thead>
				<td align="center"><b>Num Empleado</b></td>
				<td align="center"><b>Nombre</b></td>
				<td align="center"><b>Codigo</b></td>
				<td align="center"><b>Fecha Inicial</b></td>
				<td align="center"><b>Fecha Final</b></td>
				<td align="center"><b>Total Dias</b></td>
				<td align="center"><b>Periodo</b></td>
				<td align="center"><b>Acciones</b></td>
			</thead>
		</tr>
	<?php $tmp=""; ?>
	
	<?php $atributo_boton_eliminar = array('class' => 'btn btn-danger round btn-sm fa fa-trash-o', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				 ?>
	<?php 	foreach ($reporte as $row): ?> 

		<tr class="no-table" >
			
			<?php if ($tmp == $row->num_empleado): ?>
				
			<td></td>
			<td></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>
			<?php if ($row->capturada): ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-default fa fa-pencil');				 ?>
				<?php else: ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-success fa fa-pencil');				 ?>
			
			<?php endif ?>
			<td align="center">
				<?php if (!$row->capturada): ?>
					
				
				<?php echo anchor('qnas/delete/'.$row->token.'/'.$row->qna_id,' ',$atributo_boton_eliminar);?>
				<?php endif ?>
			</td>
			
		<?php else: ?>
		<tr class="no-table">
			<?php if (empty($row)) {
			 for ($i=0; $i < 8; $i++) { 
				echo "<td>&nbsp;</td>";
			} 	
			}?>
			
			
		</tr>		
			<td align="center"><?php echo $row->num_empleado;?></td>
			<td ><?php echo nombre_completo($row->nombres, $row->apellido_pat, $row->apellido_mat);?></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>

			<?php if (!$row->capturada): ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-default fa fa-pencil');	 ?>
				<?php else: ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-success fa fa-pencil');	 ?>
			
			<?php endif ?>
			<td align="center">
				
				<?php if (!$row->capturada): ?>
					<?php echo anchor('qnas/delete/'.$row->token.'/'.$row->qna_id,' ',$atributo_boton_eliminar);?>
					<?php endif ?>
			</td>
			<?php $tmp=$row->num_empleado; ?>
		<?php endif ?>
		</tr>
	<?php 	endforeach; ?>
	</table>
	
<?php endif; ?>
