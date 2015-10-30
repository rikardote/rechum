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
 		<td>Administrador</td>
	</thead>	

 	</tr>

 	<tr>

 		<?php foreach ($users as $user): ?>
 			<td><?= $user->num_empleado;?></td>
 			<td><?php echo nombre_completo($user->nombres, $user->apellido_pat,$user->apellido_mat);?></td>
 			<?php
				if($user->activated) {
					$atributo_boton_activate = array('class' => 'btn btn-success glyphicon glyphicon-off'); 
				} else {
					$atributo_boton_activate = array('class' => 'btn btn-default glyphicon glyphicon-off'); 
				}
				if($user->is_admin) {
					$atributo_boton_admin = array('class' => 'btn btn-success glyphicon glyphicon-off'); 
				} else {
					$atributo_boton_admin = array('class' => 'btn btn-default glyphicon glyphicon-off'); 
				}
			?>
			
				<td><?php echo anchor('admin/activate/'.$user->id,' ',$atributo_boton_activate);?></td>
				<td><?php echo anchor('admin/activate_admin/'.$user->id,' ',$atributo_boton_admin);?></td>
					
				
			
 	</tr>		
 		<?php endforeach ?>
 
 </table>

 <!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content col-xs-12" >
       

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>