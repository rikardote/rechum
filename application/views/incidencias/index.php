<?php if ($is_admin): ?>
	<div class="col-md-6">
		<p><button type="button" class="btn btn-primary btn-sm outline" data-toggle="modal" data-target=".bs-example-modal-sm">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

		</button></p>
	</div>
<?php endif ?>

<table class="table">
		<tr>
		<thead>
			<td><b>Codigo</b></td>
			<td><b>Descripcion</b></td>
			<?php if ($is_admin): ?>
				<td><b>Acciones</b></td>
			<?php endif ?>
		</tr>
	</thead>
		<tr>
<?php	foreach ($incidencias as $incidencia): ?>
				<?php 
					$atributo_boton_modificar = array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-sm', 'class' => 'btn btn-success btn-sm glyphicon glyphicon-pencil');
					$atributo_boton_eliminar = array('class' => 'btn btn-danger btn-sm glyphicon glyphicon-remove', 'onclick' => "javascript:return confirm('Seguro que desea eliminar este dato?')");				

				 ?>
				<td><?php echo $incidencia->incidencia_cod;?></td>
				<td><?php echo $incidencia->inc_descripcion;?></td>
			<?php if ($is_admin): ?>
				<td><?php echo anchor('incidencias/edit/'.$incidencia->id,' ',$atributo_boton_modificar);?> 
					<?php echo anchor('incidencias/delete/'.$incidencia->id,' ',$atributo_boton_eliminar);?>
				</td>
			<?php endif ?>
		</tr>
	<?php 	endforeach;?>
</table>	
	<div align="center"><ul class="pagination"> <?php echo $this->pagination->create_links(); ?> </ul></div>

	
<!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content col-xs-12" >
      <?php $this->load->view('incidencias/form'); ?>

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>