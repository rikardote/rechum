<table class="table table-condensed">
		<tr>
			<thead>	

			<td><b>Codigo</b></td>
			<td><b>Descripcion</b></td>
			
			<td align='center'><b>Acciones</b></td>
			<td></td>
			</thead>	
		
		</tr>
		
<?php	foreach ($get_all_centros as $centro): ?>
		<tr>
				<td><?php echo $centro->adscripcion;?></td>
				<td><?php echo $centro->descripcion;?></td>
			
				 
				
				<td align="center">
					<?php echo form_open('reportes/show'); ?>
					<?php echo form_dropdown('qna_id', $qnas,null,'class="form-control"'); ?>
					<?php echo '<input type="hidden", name="centro", value="'.$centro->id.'">'; ?>
				</td>
				<td>
					<?php echo form_submit('name', 'ok','class="btn btn-info round btn-sm"'); ?>
					<?php echo form_close(); ?>
				</td>
					
				
			

			</tr>
			
	<?php 	endforeach;?>
		

</table>	


