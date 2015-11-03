<?php $atributo_boton_activate = array('class' => 'btn btn-danger btn-sm glyphicon glyphicon-off'); ?>
	
<table class="table table-striped table-condensed">
	<thead>
		<td align="center"><strong>Qna</strong></td>
		<td align="center"><strong>Motivo</strong></td>
		<td align="center"><strong>Salida</strong></td>
		<td align="center"><strong>Fecha de salida</strong></td>
		
	</thead>
	<tbody>
		<?php foreach ($pases as $pase): ?>
		<td align="left"><?php echo $pase->qna_mes.'/'.$pase->qna_year.' - '.$pase->qna_descripcion;?></td>
		<td align="left"><?=$pase->motivo?></td>
		<td align="center"><?=$pase->horario?></td>
		<td align="center"><?=fecha_dma($pase->fecha_salida)?></td>
		<?php $atributos3 = array('id' => 'miFormulario3', 'name' => 'miFormulario3'); ?>
		<?php echo form_open('empleados/delete_pase',$atributos3); ?>
		<?php $id = '<p><input type="hidden" name="id" value="'.$pase->id.'"</p>'; ?>
		<?php $empleado_id = '<p><input type="hidden" name="empleado_id" value="'.$pase->empleado_id.'"</p>'; ?>
		<?php echo $id; ?>
		<?php echo $empleado_id; ?>
		<td><?php echo form_submit('submit', 'X'); ?></td>
		<?php echo form_close(); ?>
		
	</tbody>
	<?php endforeach ?>

</table>

	
<script type="text/javascript">
        // wait for the DOM to be loaded 
        $(document).ready(function() {
    		$('#miFormulario3').ajaxForm({
      			target: '#showdata2',
     			 success: function() {
      				$('#showdata2').fadeIn('slow');
      			}
    		});
 		 });
</script> 