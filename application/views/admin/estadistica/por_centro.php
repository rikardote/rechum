
<table class="table table-condensed">
		<tr>
			<thead>	

			<td><b>Codigo</b></td>
			<td><b>Descripcion</b></td>
			
			<td align='center'><b>Acciones</b></td>
			</thead>	
		
		</tr>
		
<?php	foreach ($get_all_incidencias as $incidencia): ?>
		<tr>
				<?php 
					$atributo_boton_modificar = array('class' => 'btn btn-cm-linkedin btn-xs glyphicon glyphicon-pencil');
					$atributo_boton_eliminar = array('class' => 'btn btn-danger glyphicon glyphicon-remove', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				
				 ?>
				<td><?php echo $incidencia->adscripcion;?></td>
				<td><?php echo $incidencia->descripcion;?></td>
			
				
				
				<td align='center'>
					<?php echo anchor('admin/estadistica_totales_centro/'.$incidencia->adscripcion_id.'/'.$fecha_inicial.'/'.$fecha_final,' ',$atributo_boton_modificar);?> 
					
				</td>
			

			</tr>
			
	<?php 	endforeach;?>
		

</table>	


<?php echo anchor('admin/estadistica', '<i class="fa fa-chevron-circle-left fa-2x"></i>'); ?>