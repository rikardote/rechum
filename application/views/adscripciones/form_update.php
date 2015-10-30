
<?php 
$id = '<p><input type="hidden" name="id" value="'.$this->uri->segment(3).'"</p>';
$adscripcion = $actualizar->adscripcion;

$descripcion = $actualizar->descripcion;
?>

<div class="form-group">

<?php $atributos = array('id' => 'miFormulario2', 'name' => 'miFormulario2'); ?>	
<?php $atribs_ads = array('id' => 'adscripcion','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('adscripciones/update',$atributos);?>
<?php   echo $id; ?>
<?php	echo form_label('Adscripcion', 'adscripcion');?>
<?php	echo form_input('adscripcion',$adscripcion,$atribs_ads);?>
<?php	echo form_label('Descripcion', 'descripcion');?>
<?php	echo form_input('descripcion',$descripcion,$atribs_des); ?>    


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
			url: '<?php echo site_url("adscripciones/update");?>',
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