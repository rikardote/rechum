<?php $atributo_boton_capturar = array('class' => 'btn btn-success glyphicon glyphicon-pencil'); ?>
<p>Seleccione un rango de fechas: </p>
<table class="table table-condensed">
	<div class="col-md-6">
	<tr>
			
			<td>
			<div class="form-group">
				<?php $data = array(
		        'class'    => 'form-inline',
		    
			);
			?>
				
				<?php echo form_open('reportes/get_reporte_sin_derecho', $data); ?>
				<?php 
				$data = array(
			        
			        'name'  => 'fecha_inicial',
			        'id'    => 'fecha_inicial',
			        'class'    => 'form-control',
			        'placeholder' => 'Fecha Inicial',
			        
			        
			        
				);
				?>
				
				<div class="col-xs-3 input-group">
					<?php	echo form_input('fecha_inicial','' ,$data); ?>
					<span class="input-group-addon "><i class="fa fa-calendar"></i></span> 
					 
				</div>
				<?php 
					$data = array(
			        
			        'name'  => 'fecha_final',
			        'id'    => 'fecha_final',
			         'class'    => 'form-control',
			        'placeholder' => 'Fecha Final'
			        
				);
				?>
				
				<div class="col-xs-3 input-group">
					<?php	echo form_input('fecha_final','' ,$data); ?>
					<span class="input-group-addon "><i class="fa fa-calendar"></i></span> 
					 
				</div>
				<?php echo form_submit('name', 'Ok','class = "btn btn-primary  round btn-xs "'); ?>
				
				<?php echo form_close(); ?>

			</div>
			</td>
		</tr>
	</div>
</table>














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