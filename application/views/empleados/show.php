<?php  //echo validation_errors(); ?>
<?php if ($is_admin==1): ?>
	<div class="col-xs-6">
		<p><button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</button>
		</p>
	</div>
<?php endif ?>


<?php $this->load->view('empleados/search'); ?>



<div class="col-xs-12">
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_a" data-toggle="tab">Datos Generales</a></li>
  <li><a href="#tab_b" data-toggle="tab">Datos laborales</a></li>
  <li><a href="#tab_c" data-toggle="tab">Tab C</a></li>
  <li><a href="#tab_d" data-toggle="tab">Tab D</a></li>
</ul>
<div class="tab-content">
        <div class="tab-pane active" id="tab_a">
        
			<table class="table table-striped">
					<tr>
						<td>Numero de Empleado</td>
						<td>Nombre</td>
						<td>Adscripcion</td>
						<?php if ($is_admin==1): ?>	
							<td>Acciones</td>
						<?php endif ?>
					</tr>
			<tr>
			<?php if (isset($empleado)): ?>
				<?php 
					$atributo_boton_modificar = array('data-toggle' => 'modal', 'data-target' => '.bs-example-modal-lg', 'class' => 'btn btn-warning glyphicon glyphicon-pencil');
							
				?>
				<?php
					if($empleado->activo) {
						$atributo_boton_activate = array('class' => 'btn btn-default raised glyphicon glyphicon-off'); 
					} else {
						$atributo_boton_activate = array('class' => 'btn btn-info raised glyphicon glyphicon-off'); 
					}
				?>
				<td><?php echo $empleado->num_empleado;?></td>
				<td><?php echo nombre_completo($empleado->nombres,$empleado->apellido_pat,$empleado->apellido_mat); ?></td>
				<td><?php echo $empleado->adscripcion;?></td>
				<?php if ($is_admin==1): ?>		
				<td>							
					<?php echo anchor('empleados/delete/'.$empleado->id,' ',$atributo_boton_activate);?>
					<?php echo anchor('empleados/edit/'.$empleado->id,' ',$atributo_boton_modificar);?> 
				</td>
				<?php endif ?>
			</tr>

			<?php endif ?>
			</table>	
		</div>


        <div class="tab-pane" id="tab_b">
            <h4>Datos laborales</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
        <div class="tab-pane" id="tab_c">
            <h4>Pane C</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
        <div class="tab-pane" id="tab_d">
            <h4>Pane D</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
</div><!-- tab content -->	
</div>

	

<!-- Small modal -->


<div id="mymodal"class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content col-xs-12" >
      <?php $this->load->view('empleados/form'); ?>

    </div>
  </div>
</div>
<script>
	$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true);
})
</script>