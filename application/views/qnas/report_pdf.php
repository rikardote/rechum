<?php if (isset($reporte)): ?>

	<table style="font-size:9.5pt text-align:center; border-spacing:0;font-family:family:Arial; ">
		<tr>
			<thead>
				<td><b>Num Emp</b></td>
				<td align="center"><b>Nombre</b></td>
				<td><b>|Codigo|</b></td>
				<td><b>Fecha Inicial|</b></td>
				<td><b>Fecha Final|</b></td>
				<td><b>Dias|</b></td>
				<td><b>Periodo</b></td>
				
			</thead>
		</tr>
	<?php $tmp=""; ?>
	
	
	<?php 	foreach ($reporte as $row): ?> 

		<tr>
			
			<?php if ($tmp == $row->num_empleado): ?>
				
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>
			
			
		<?php else: ?>
		<tr style="background:#000 padding-bottom:3mm;">
			<?php if (empty($row)) {
			 for ($i=0; $i < 8; $i++) { 
				echo '<td></td>';
			} 	
			}?>
		</tr>	
		<tr>
		<tbody>
			<td align="center"><?php echo $row->num_empleado;?></td>
			<td ><?php echo nombre_completo($row->nombres, $row->apellido_pat, $row->apellido_mat);?></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>

			
			<?php $tmp=$row->num_empleado; ?>
		<?php endif ?>
		</tbody>
		</tr>
	<?php 	endforeach; ?>
	</table>
	
<?php endif; ?>
