
<!-- Centered Pills -->
<ul class="nav nav-pills nav-center">

  <li><?php echo anchor('admin/capturar_por_incidencia/'.$qna_id.'/100', 'Incidencias<span class="badge badge-cm-linkedin">'.get_total_pendientes2($qna_id,100).'</span>', 'class= "btn btn-primary btn-sm btn-sm gradient"'); ?></li>
  <li><?php echo anchor('admin/capturar_por_incidencia/'.$qna_id.'/200', 'Licencias/Permisos<span class="badge badge-cm-linkedin">'.get_total_pendientes2($qna_id,200).'</span>', 'class= "btn btn-primary btn-sm gradient"'); ?></li>
  <li><?php echo anchor('admin/capturar_por_incidencia/'.$qna_id.'/300', 'Vacaciones<span class="badge badge-cm-linkedin">'.get_total_pendientes2($qna_id,300).'</span>', 'class= "btn btn-primary btn-sm gradient"'); ?></li>
  <li><?php echo anchor('admin/capturar_por_incidencia/'.$qna_id.'/400', 'Otros<span class="badge badge-cm-linkedin">'.get_total_pendientes2($qna_id,400).'</span>', 'class= "btn btn-primary btn-sm gradient"'); ?></li>
</ul>


<?php if (isset($get_all_incidencias)): ?>
	
	<table class="table table-condensed">
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
	<?php 	foreach ($get_all_incidencias as $row): ?> 

		<tr class="no-table"> 
			
			<?php if ($tmp == $row->num_empleado): ?>
				
			<td></td>
			<td></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>
			<?php if ($row->capturada): ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-default round btn-sm fa fa-pencil');				 ?>
				<?php else: ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-success round btn-sm fa fa-pencil');				 ?>
			
			<?php endif ?>
			<td align="center">
				<?php echo anchor('admin/capturada2/'.$row->token.'/'.$row->qna_id.'/'.$row->grupo,' ',$atributo_boton_capturado);?>
				<?php echo anchor('admin/capturada/'.$row->token.'/'.$row->qna_id.'/'.$row->grupo,' ',$atributo_boton_eliminar);?>
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
			<td><?php echo nombre_completo($row->nombres, $row->apellido_pat, $row->apellido_mat);?></td>
			<td align="center"><?php echo $row->incidencia_cod;?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_inicial);?></td>
			<td align="center"><?php echo fecha_dma($row->fecha_final);?></td>
			<td align="center"><?php echo $row->conteo;?></td>
			<td align="center"><?php if ($row->perio_id!=10) {echo $row->period.'/'.$row->year; }?></td>
			<?php if ($row->capturada): ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-default round btn-sm fa fa-pencil');				 ?>
				<?php else: ?>
				<?php $atributo_boton_capturado = array('class' => 'btn btn-success round btn-sm fa fa-pencil');				 ?>
			
			<?php endif ?>
			<td align="center">
				<?php echo anchor('admin/capturada2/'.$row->token.'/'.$row->qna_id.'/'.$row->grupo,' ',$atributo_boton_capturado);?>
				<?php echo anchor('admin/capturada2/'.$row->token.'/'.$row->qna_id.'/'.$row->grupo,' ',$atributo_boton_eliminar);?>
			</td>
			<?php $tmp=$row->num_empleado; ?>
		<?php endif ?>
		</tr>
	<?php 	endforeach; ?>
	</table>
<?php endif; ?>
<?php echo anchor('admin/capturar', '<i class="fa fa-chevron-circle-left fa-2x"></i>'); ?>