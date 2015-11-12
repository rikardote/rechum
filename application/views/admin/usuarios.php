<div class="col-md-6">
	
		<?php echo anchor('admin/register', ' <i class="fa fa-user-plus fa-3x"></i>'); ?>
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
 			<td><?= '<strong>'.$user->num_empleado.'</strong>';?></td>
 			<td><?php echo '<strong>'.nombre_completo($user->nombres, $user->apellido_pat,$user->apellido_mat).'</strong>';?>
				<br><?php echo '<small><i>'.$user->descripcion.'</i></small>'; ?>
 			</td>
 			

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
				<td><?php echo anchor('admin/asignar_centro/'.$user->id, '<span class="btn btn-info btn-sm glyphicon glyphicon-edit"></span>'); ?></td>

		
				<td><?php echo anchor('admin/activate_admin/'.$user->id,' ',$atributo_boton_admin);?></td>
					
				
			
 	</tr>		
 		<?php endforeach ?>
 
 </table>

 <!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-ls">
    <div class="modal-content">

	 

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>