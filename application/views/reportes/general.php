<table class="table table-condensed">
		<tr>
			<thead>	

			<td><b>Codigo</b></td>
			<td><b>Descripcion</b></td>
			
			<td align='center'><b>Acciones</b></td>
			</thead>	
		
		</tr>
		
<?php	foreach ($get_all_centros as $centro): ?>
		<tr>
				<?php 
					$atributo_boton_modificar = array('class' => 'btn btn-cm-linkedin btn-xs glyphicon glyphicon-pencil');
					$atributo_boton_eliminar = array('class' => 'btn btn-danger glyphicon glyphicon-remove', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				
				 ?>
				<td><?php echo $centro->adscripcion;?></td>
				<td><?php echo $centro->descripcion;?></td>
			
				
				
				<td align='center'>
					<?php echo form_open('reportes/show'); ?>
					<?php echo form_dropdown('qna_id', $qnas); ?>
					<?php echo '<input type="hidden", name="centro", value="'.$centro->id.'">'; ?>
					<?php echo form_submit('name', 'Ok'); ?>
					
					<?php echo form_close(); ?>
				</td>
			

			</tr>
			
	<?php 	endforeach;?>
		

</table>	

