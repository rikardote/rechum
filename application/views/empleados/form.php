

<div class="form-group">
<?php $atributos = array('id' => 'miFormulario', 'name' => 'miFormulario','autocomplete' => 'off'); ?>	
<?php $atribs_ads = array('id' => 'adscripcion','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribs_num = array('id' => 'numero_empleado','name' => 'num_empleado','class' => 'form-control'); ?>	
<?php $atribs_nombres = array('id' => 'nombres','name' => 'nombres','class' => 'form-control'); ?>	
<?php $atribs_pat = array('id' => 'apellido_pat','name' => 'apellido_pat','class' => 'form-control'); ?>	
<?php $atribs_mat = array('id' => 'apellido_mat','name' => 'apellido_mat','class' => 'form-control'); ?>	


<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>		
<?php 	echo form_open('empleados/add', $atributos);?>

<?php	echo form_label('Numero de Empleado', 'num_empleado');?>
<?php	echo form_input('num_empleado',null, $atribs_num);?>
<?php	echo form_label('Nombre(s)', 'nombres');?>
<?php	echo form_input('nombres',null,$atribs_nombres);   ?>  
<?php	echo form_label('Apellido Paterno', 'apellido_pat');?>
<?php	echo form_input('apellido_pat',null,$atribs_pat); ?>
<?php	echo form_label('Apellido Materno', 'apellido_pat');?>
<?php	echo form_input('apellido_mat',null,$atribs_mat); ?>
<?php	echo form_label('Adscripcion', 'adscripcion_id');?> 
<?php	echo form_dropdown('adscripcion_id',$options,null,$atribs_ads); ?>
<?php $atribs_numseg = array('id' => 'num_seguro','name' => 'num_seguro','class' => 'form-control'); ?>	
<?php $atribs_plaza = array('id' => 'num_plaza','name' => 'num_plaza','class' => 'form-control'); ?>	
<?php $atribs_horario = array('id' => 'horario_id','name' => 'horario_id','class' => 'form-control'); ?>	
<?php $atribs_puesto = array('id' => 'puesto_id','name' => 'puesto_id','class' => 'form-control'); ?>	
<?php	echo form_label('Numero de plaza','num_plaza');?>
<?php	echo form_input('num_plaza',null, $atribs_plaza);?>
<?php	echo form_label('Num de Seguro Social', 'num_seguro');?>
<?php	echo form_input('num_seguro',null, $atribs_numseg);   ?>  
<?php	echo form_label('Horario', 'horario_id');?>
<?php	echo form_dropdown('horario_id',$horarios,null,$atribs_horario); ?>
<?php	echo form_label('Puesto', 'puesto_id');?>
<?php	echo form_dropdown('puesto_id',$puestos,null,$atribs_puesto); ?>


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
				$("#msg").html(data);
				

			}
		});

		return false;
	});
});

	
</script>