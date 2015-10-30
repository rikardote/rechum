

<div class="form-group">
<?php $atributos = array('id' => 'miFormulario', 'name' => 'miFormulario'); ?>	
<?php $atribs_ads = array('id' => 'adscripcion','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>		
<?php 	echo form_open('empleados/add', $atributos);?>
<?php	echo form_label('Numero de Empleado', 'num_empleado');?>
<?php	echo form_input('num_empleado','','class="form-control"');?>
<?php	echo form_label('Nombre(s)', 'nombres');?>
<?php	echo form_input('nombres','','class="form-control"');   ?>  
<?php	echo form_label('Apellido Paterno', 'apellido_pat');?>
<?php	echo form_input('apellido_pat','','class="form-control"'); ?>
<?php	echo form_label('Apellido Materno', 'apellido_pat');?>
<?php	echo form_input('apellido_mat','','class="form-control"'); ?>
<?php	echo form_label('Adscripcion', 'adscripcion_id');?> 
<?php	echo form_dropdown('adscripcion_id',$options,'','class="form-control"'); ?>


<div id="msg"></div>
<br>
<?php	echo form_submit('Submit', 'Enviar','class="btn btn-primary"');?>
<?php	echo form_close();?>
	
</div> 


<script type="text/javascript">
$(document).ready(function(){
	$("#miFormulario").submit(function( event ){
		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("empleados/add");?>',
			data: $(this).serialize(),
			success: function(data){
				$("#msg").slideDown();
				
				window.location = "<?php echo site_url('empleados/show/');?>/" + data;
				

			}
		});

		return false;
	});
});

	
</script>