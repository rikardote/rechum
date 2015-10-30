<div class="form-group">
<?php $atributos = array('id' => 'miFormulario', 'name' => 'miFormulario'); ?>	
<?php $atribs_qna = array('id' => 'qna_mes','name' => 'nombre','class' => 'form-control'); ?>	
<?php $atribs_year = array('id' => 'qna_year','name' => 'qna_year','class' => 'form-control'); ?>	
<?php $atribs_descripcion = array('id' => 'qna_descripcion','name' => 'qna_descripcion','class' => 'form-control'); ?>	
<?php $atribbs = array('id' => 'submit', 'class' => 'btn btn-primary'); ?>	
<?php 	echo form_open('qnas/add',$atributos);?>
<?php	echo form_label('Qna', 'qna_mes');?>
<?php	echo form_input('qna_mes','',$atribs_qna);?>
<?php	echo form_label('ANO', 'qna_year');?>
<?php	echo form_input('qna_year','',$atribs_year);?>     
<?php	echo form_label('Descripcion', 'qna_descripcion');?>
<?php	echo form_input('qna_descripcion','',$atribs_descripcion);   ?> 
 
<div id="msg"></div>	
<br>	
<?php	echo form_submit('submit', 'Enviar', $atribbs);?>
<?php	echo form_close();?>
	
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#miFormulario").submit(function( event ){
		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("qnas/add");?>',
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
