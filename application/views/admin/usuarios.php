<div class="col-md-6">
	<?php $nuevo_boton = array('class' => 'glyphicon glyphicon-plus'); ?>
		<?php echo anchor('admin/register', ' ',$nuevo_boton); ?>
	</div>
 <table class="table">
 	<tr>
	<thead>	

 		<td>Num Empleado</td>
 		<td>Nombre</td>
 		<td>Activo</td>
 		<td>Centros</td>
 		<td>Administrador</td>

	</thead>	

 	</tr>

 	<tr>

 		<?php foreach ($users as $user): ?>
 			<td><?= $user->num_empleado;?></td>
 			<td><?php echo nombre_completo($user->nombres, $user->apellido_pat,$user->apellido_mat);?></td>
 			<?php
				if($user->activated) {
					$atributo_boton_activate = array('class' => 'btn btn-success btn-sm glyphicon glyphicon-off'); 
				} else {
					$atributo_boton_activate = array('class' => 'btn btn-default btn-sm glyphicon glyphicon-off'); 
				}
				if($user->is_admin) {
					$atributo_boton_admin = array('class' => 'btn btn-success btn-sm glyphicon glyphicon-off'); 
				} else {
					$atributo_boton_admin = array('class' => 'btn btn-default btn-sm glyphicon glyphicon-off'); 
				}
			?>
			
				<td><?php echo anchor('admin/activate/'.$user->id,' ',$atributo_boton_activate);?></td>
				<td><button type="button" class="btn btn-primary btn-sm outline" data-toggle="modal" data-target=".bs-example-modal-sm">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

		</button></td>
				<td><?php echo anchor('admin/activate_admin/'.$user->id,' ',$atributo_boton_admin);?></td>
					
				
			
 	</tr>		
 		<?php endforeach ?>
 
 </table>

 <!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-ls">
    <div class="modal-content">

	 <?php $this->load->view('admin/list_ads', $centros); ?>       

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>