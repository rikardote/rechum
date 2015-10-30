
<div class="form-group">
<?php $options = array(
				  '0'  => 'Seleccion un grupo...',	
                  '100'  => 'INCIDENCIAS',
                  '200'    => 'LICENCIAS/PERMISOS',
                  '300'   => 'VACACIONES',
                  '400' => 'OTROS',
                );
?>

<?php $atributos = array('id' => 'miFormulario', 'name' => 'miFormulario'); ?>	
<?php $atribs_ads = array('id' => 'incidencia_cod','name' => 'codigo','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'inc_descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('incidencias/add',$atributos);?>

<?php	echo form_label('Codigo de Incidencia', 'incidencia_id');?>
<?php	echo form_input('incidencia_cod','',$atribs_ads);?>
<?php	echo form_label('Descripcion', 'inc_descripcion');?>
<?php	echo form_input('inc_descripcion','',$atribs_des); ?> 
<?php	echo form_label('Grupo de incidencia', 'grupo');?>  
<?php   echo form_dropdown('grupo', $options, '0','class = form-control'); ?>


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
			url: '<?php echo site_url("incidencias/add");?>',
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