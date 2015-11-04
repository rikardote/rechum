<script type="text/javascript">
        // wait for the DOM to be loaded 
        $(document).ready(function() {
    		$('#miFormulario').ajaxForm({
      			target: '#showdata',
     			 success: function() {
      				$('#showdata').fadeIn('slow');
      			}
    		});
 		 });
</script> 



<?php $qna_completas = $qna->qna_mes.'/'.$qna->qna_year.' - '.$qna->qna_descripcion; ?>
<?php $empleado_completo = nombre_completo($empleado->nombres,$empleado->apellido_pat,$empleado->apellido_mat);?>


<?php $atributos = array('id' => 'miFormulario', 'autocomplete' => 'off', 'name' => 'miFormulario'); ?>
<?php $atribs_fechainicial = array('id' => 'fecha_inicial', 'class' => 'form-control'); ?>
	
	<?php 	echo form_open('captura/add',$atributos); ?>
	<div class="form-group">
		<?php 
			$data = array(
		        'type'  => 'hidden',
		        'name'  => 'qna_id',
		        'id'    => 'qna_id',
		        'value' => $qna->id,
		        
			);
		?>
		<?php	echo form_label('Qna: '.$qna_completas, 'qna_id');?>
		<?php	echo form_input($data);?>
	</div>
	<div class="form-group">
		<?php 
			$data = array(
		        'type'  => 'hidden',
		        'name'  => 'empleado_id',
		        'id'    => 'empleado_id',
		        'value' => $empleado->id,
		        
			);
		?>
		<?php	echo form_label($empleado->num_empleado.' - '.$empleado_completo, 'empleado_id');?>
		<?php	echo form_input($data); ?> 
	</div>
	<div class="form-group">
		<?php	echo form_label('Codigo de incidencia', 'incidencia_cod'); ?> 
		<?php	echo form_dropdown('incidencia_id',$options,'' ,'class="form-control"');  ?>
	</div>
	<div class="form-group" >
		<?php 
			$data = array(
		        
		        'name'  => 'fecha_inicial',
		        'id'    => 'fecha_inicial',
		        'class' => 'form-control'
		        
			);
		?>
		<?php	echo form_label('Fecha inicial', 'fecha_inicial'); ?>
		<div class="input-group">
				<?php	echo form_input('fecha_inicial','' ,$data); ?>
				<span class="input-group-addon "><i class="fa fa-calendar"></i></span> 
					 
		</div>
		
		
	</div>
	<div class="form-group" >
		<?php 
			$data = array(
		        
		        'name'  => 'fecha_final',
		        'id'    => 'fecha_final',
		        'class' => 'form-control'
		        
			);
		?>
		<?php	echo form_label('Fecha final', 'fecha_final');?>
		<div class="input-group">
				<?php	echo form_input('fecha_final','' ,$data); ?>
				<span class="input-group-addon "><i class="fa fa-calendar"></i></span> 
					 
		</div>
	</div>
	<div class="form-group">
		<?php	echo form_label('Periodo', 'periodo');?>
		<?php	echo form_dropdown('periodo_id',$periodos,'' ,'class="form-control"');  ?>
	</div>
	<div class="form-group">	
		
		<?php $this->load->view('errors/display'); ?>
		
		<?php $data = array('class' => 'btn btn-primary round' ); ?>
		
		<?php echo form_submit('Submit', 'guardar',$data);?>
		
		<?php	echo form_close();?>
	</div>
	
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<script>
$.datepicker.setDefaults($.datepicker.regional['es-MX']);
$('#fecha_inicial').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1,
    onClose: function () {
        $('#fecha_final').val(this.value);
    }
});
$('#fecha_final').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1
});
</script> 



