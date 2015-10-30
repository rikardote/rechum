<?php if ($is_admin): ?>
	<div class="col-md-6">
		<p><button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

		</button></p>
	</div>
<?php endif ?>

	

<table class="table">
		<tr>
		<thead>
			<td><b>Periodo</b></td>
			<td><b>Ano</b></td>
			<?php if ($is_admin): ?>
				<td><b>Acciones</b></td>
			<?php endif ?>
		</thead>
		</tr>
		<tr>
<?php	foreach ($periodos as $periodo): ?>
			
				<?php 
					$atributo_boton_modificar = array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-sm', 'class' => 'btn btn-success glyphicon glyphicon-pencil');
					$atributo_boton_eliminar = array('class' => 'btn btn-danger glyphicon glyphicon-remove', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				
				 ?>
				 <?php
					if($periodo->activo) {
						$atributo_boton_activate = array('class' => 'btn btn-default raised glyphicon glyphicon-off'); 
					} else {
						$atributo_boton_activate = array('class' => 'btn btn-info raised glyphicon glyphicon-off'); 
					}
				?>
				<?php if ($periodo->id != 10): ?>
					<td><?php echo $periodo->period;?></td>
					<td><?php echo $periodo->year;?></td>
					<?php if ($is_admin): ?>
						<td>
							<?php echo anchor('periodos/activate/'.$periodo->id,' ',$atributo_boton_activate);?>
							<?php echo anchor('periodos/edit/'.$periodo->id,' ',$atributo_boton_modificar);?> 
							<?php echo anchor('periodos/delete/'.$periodo->id,' ',$atributo_boton_eliminar);?>
						</td>
					<?php endif ?>			
				<?php endif; ?>
	</tr>			
	<?php 	endforeach;?>
	


</table>	
	<div align="center"><ul class="pagination"> <?php echo $this->pagination->create_links(); ?> </ul></div>


<!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content col-xs-12" >
      <?php $this->load->view('periodos/form'); ?>

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>
