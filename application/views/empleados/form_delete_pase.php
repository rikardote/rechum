<?php $atributos3 = array('id' => 'miFormulario3', 'name' => 'miFormulario3'); ?>
<?php echo form_open('empleados/delete_pase',$atributos3); ?>
<?php $id = '<p><input type="hidden" name="id" value="'.$pase->id.'"</p>'; ?>
<?php $empleado_id = '<p><input type="hidden" name="empleado_id" value="'.$pase->empleado_id.'"</p>'; ?>
<?php echo $id; ?>
<?php echo $empleado_id; ?>
<td><?php echo form_submit('submit', 'X'); ?></td>
<?php echo form_close(); ?>