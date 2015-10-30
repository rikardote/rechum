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
				<?php	echo form_label('Estadistica por Delegacion', 'fecha_final');?>
				<?php echo form_open('admin/estadistica_por_delegacion', $data); ?>
				<?php 
				$data = array(
			        
			        'name'  => 'fecha_inicial',
			        'id'    => 'fecha_inicial',
			        'class'    => 'form-control',
			        'placeholder' => 'Fecha Inicial'
			        
			        
				);
				?>
				
				<div class="col-xs-3">
					<span class="glyphicon glyphicon-calendar">
					</span>                   
					<?php	echo form_input('fecha_inicial','' ,$data); ?>
					 
				</div>
				<?php 
					$data = array(
			        
			        'name'  => 'fecha_final',
			        'id'    => 'fecha_final',
			         'class'    => 'form-control',
			        'placeholder' => 'Fecha Final'
			        
				);
				?>
				
				<div class="col-xs-3">
					<?php	echo form_input('fecha_final','' ,$data); ?>
				</div>
				<?php echo form_submit('name', 'Ok','class = "btn btn-primary  round btn-xs "'); ?>
				
				<?php echo form_close(); ?>

			</div>
			</td>
		</tr>
		<tr>
			
			<td>
			<div class="form-group">
			<?php $data = array(
		        'class'    => 'form-inline',
		    
			);
			?>
			<?php	echo form_label('Estadistica por centro de trabajo', 'fecha_final');?>
			<?php echo form_open('admin/estadistica_por_centro', $data); ?>
			<?php 
			$data = array(
		        
		        'name'  => 'fecha_inicial2',
		        'id'    => 'fecha_inicial2',
		        'class'    => 'form-control',
		        'placeholder' => 'Fecha Inicial'
		        
			);
			?>
			<div class="col-xs-3">
				
				<?php	echo form_input('fecha_inicial2','' ,$data); ?>
			</div>
			<?php 
				$data = array(
		        
		        'name'  => 'fecha_final2',
		        'id'    => 'fecha_final2',
		        'class'    => 'form-control',
		        'placeholder' => 'Fecha Final'
		        
			);
			?>
			<div class="col-xs-3">
				
				<?php	echo form_input('fecha_final2','' ,$data); ?>
			</div>
			<?php echo form_submit('name', 'Ok','class = "btn btn-primary  round btn-xs "'); ?>
			<?php echo form_close(); ?>
			</div>
			</td>
			</div>
			</td>
		</tr>
		<tr>
			
			<td>
			<div class="form-group">
			<?php $data = array(
		        'class'    => 'form-inline',
		    
			);
			?>
			<?php	echo form_label('Estadistica por empleado', 'fecha_final');?>
			<?php echo form_open('admin/estadistica_por_empleado',$data); ?>
			<?php 
			$data = array(
		        
		        'name'  => 'fecha_inicial3',
		        'id'    => 'fecha_inicial3',
		         'class'    => 'form-control',
		        'placeholder' => 'Fecha Inicial'
		        
			);
			?>
			
			<div class="col-xs-3">
				
				<?php	echo form_input('fecha_inicial3','' ,$data); ?>
			</div>
			
			<?php 
				$data = array(
		        
		        'name'  => 'fecha_final3',
		        'id'    => 'fecha_final3',
		         'class'    => 'form-control',
		        'placeholder' => 'Fecha Final'
		        
			);
			?>
			
			<div class="col-xs-3">
				<?php	echo form_input('fecha_final3','' ,$data); ?>
			</div>
			<?php echo form_submit('name', 'Ok','class = "btn btn-primary  round btn-xs "'); ?>
			<?php echo form_close(); ?>
			</div>
			</td>
			</div>

			</td>
		</tr>
		
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

<script>
$.datepicker.setDefaults($.datepicker.regional['es-MX']);
$('#fecha_inicial2').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1,
    onClose: function () {
        $('#fecha_final2').val(this.value);
    }
});
$('#fecha_final2').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1
});
</script>
<script>
$.datepicker.setDefaults($.datepicker.regional['es-MX']);
$('#fecha_inicial3').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1,
    onClose: function () {
        $('#fecha_final3').val(this.value);
    }
});
$('#fecha_final3').datepicker({
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    firstDay: 1
});
</script>
