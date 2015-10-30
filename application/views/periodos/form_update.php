
<?php 
$id = '<p><input type="hidden" name="id" value="'.$this->uri->segment(3).'"</p>';
$periodo = $actualizar->period;

$year = $actualizar->year;
?>

<div class="form-group">

<?php $atributos = array('id' => 'miFormulario2', 'name' => 'miFormulario2'); ?>	
<?php $atribs_ads = array('id' => 'adscripcion','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_des = array('id' => 'descripcion','name' => 'descripcion','class' => 'form-control'); ?>	

<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('periodos/add',$atributos);?>
<?php   echo $id; ?>


<?php	echo form_label('Periodo', 'periodo');?>
<?php	echo form_input('period',$periodo,$atribs_ads);?>
<?php	echo form_label('Ano', 'ano');?>
<?php	echo form_input('year',$year,$atribs_des); ?>   


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
			url: '<?php echo site_url("periodos/update");?>',
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