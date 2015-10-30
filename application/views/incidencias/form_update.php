
<?php 
$id = '<p><input type="hidden" name="id" value="'.$this->uri->segment(3).'"</p>';
$incidencia = $actualizar->incidencia_cod;
$descripcion = $actualizar->inc_descripcion;
$grupo = $actualizar->grupo;
?>

<div class="form-group">
<?php $options = array(
				  '0'  => 'Seleccion un grupo...',	
                  '100'  => 'INCIDENCIAS',
                  '200'    => 'LICENCIAS/PERMISOS',
                  '300'   => 'VACACIONES',
                  '400' => 'OTROS',
                );	
?>

<?php $atributos = array('id' => 'miFormulario2', 'name' => 'miFormulario2'); ?>	
<?php $atribs_ads = array('id' => 'incidencia_cod','name' => 'incidencia_cod','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'inc_descripcion','name' => 'inc_descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('incidencias/update',$atributos);?>
<?php   echo $id; ?>
<?php	echo form_label('Incidencia', 'incidencia_cod');?>
<?php	echo form_input('incidencia_cod',$incidencia,$atribs_ads);?>
<?php	echo form_label('Descripcion', 'inc_descripcion');?>
<?php	echo form_input('inc_descripcion',$descripcion,$atribs_des); ?>  
<?php	echo form_label('Grupo de incidencia', 'grupo');?>
<?php   echo form_dropdown('grupo', $options, $grupo,'class = form-control'); ?>  


<div id="msg"></div>	
<br>
<?php	echo form_submit('Submit', 'Enviar','class="btn btn-primary"');?>
<?php	echo form_close();?>
	
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#miFormulario2").submit(function( event ){
		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("incidencias/update");?>',
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