<?php 
$id = '<p><input type="hidden" name="id" value="'.$this->uri->segment(3).'"</p>';
$qna_mes = $actualizar->qna_mes;
$qna_year = $actualizar->qna_year;
$qna_descripcion = $actualizar->qna_descripcion;
?>



<div class="form-group">
<?php $atributos = array('id' => 'miFormulario2', 'name' => 'miFormulario2'); ?>	
<?php $atribs_qna = array('id' => 'qna_mes','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_year = array('id' => 'qna_year','name' => 'qna_year','class' => 'form-control'); ?>	
<?php $atribs_descripcion = array('id' => 'qna_descripcion','name' => 'qna_descripcion','class' => 'form-control'); ?>	
<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('qnas/update',$atributos);?>
<?php 	echo $id; ?>
<?php	echo form_label('Qna', 'qna_mes');?>
<?php	echo form_input('qna_mes',$qna_mes,$atribs_qna);?>
<?php	echo form_label('ANO', 'qna_year');?>
<?php	echo form_input('qna_year',$qna_year,$atribs_year);?>     
<?php	echo form_label('Descripcion', 'qna_descripcion');?>
<?php	echo form_input('qna_descripcion',$qna_descripcion,$atribs_descripcion);   ?>  
<div id="msg"></div>	
<br>	

<?php	echo form_submit('submit', 'Enviar', $atribbs);?>	





<?php	echo form_close();?>

	
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#miFormulario2").submit(function( event ){
		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("qnas/update");?>',
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

