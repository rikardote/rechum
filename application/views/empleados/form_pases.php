	<div class="form-group">
		<?php $atributos = array('id' => 'miFormulario2', 'name' => 'miFormulario2'); ?>
		<?php $id = '<p><input type="hidden" name="empleado_id" value="'.$empleado_id.'"</p>'; ?>
		<?php echo form_open('empleados/agregar_pase', $atributos); ?>
		<?php echo $id; ?>
		<?php echo form_label('Selecciona la qna...', 'username'); ?>
		<?php echo form_dropdown('qna_id',$qnas,'' ,'class="form-control"');  ?>
		<?php echo form_label('Motivo', 'motivo'); ?>
		<?php echo form_input('motivo', '', "class='form-control'"); ?>
		<?php echo form_label('Salida', 'salida'); ?>
		<?php echo form_input('horario', '', "class='form-control'"); ?>
		<?php echo form_label('Fecha de salida', 'fecha_salida'); ?>
		<?php echo form_input('fecha_salida', '', "class='form-control'"); ?>
		<p><?php echo form_submit('Submit', 'Ingresar',"class='btn btn-primary form-control'"); ?></p>
		<?php echo form_close(); ?>
	</div>
	
<script type="text/javascript">
        // wait for the DOM to be loaded 
        $(document).ready(function() {
    		$('#miFormulario2').ajaxForm({
      			target: '#showdata2',
     			 success: function() {
      				$('#showdata2').fadeIn('slow');
      			}
    		});
 		 });
</script> 