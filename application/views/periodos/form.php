

<div class="form-group">

<?php $atributos = array('id' => 'miFormulario', 'name' => 'miFormulario'); ?>	
<?php $atribs_ads = array('id' => 'adscripcion','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('periodos/add',$atributos);?>

<?php	echo form_label('Periodo', 'periodo');?>
<?php	echo form_input('period','',$atribs_ads);?>
<?php	echo form_label('Ano', 'ano');?>
<?php	echo form_input('year','',$atribs_des); ?>    


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
			url: '<?php echo site_url("periodos/add");?>',
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