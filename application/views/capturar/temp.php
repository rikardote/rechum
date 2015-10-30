<?php $this->load->view('capturar/search'); ?>


<div class="col-md-6">
<?php 	foreach ($capturas as $row): ?> 
<?php 		echo "Qna: "; ?>
<?php 		echo $row->qna_mes.'/'.$row->qna_year.' '.$row->qna_descripcion.'<br>'; ?>
<?php		echo "Empleado: "; ?>
<?php  		echo nombre_completo($row->nombres,$row->apellido_pat,$row->apellido_mat.'<br>'); ?>
<?php  		echo "Incidencia: "; ?>
<?php		echo $row->incidencia_cod.'<br>';?>
<?php  		echo "Fecha inicial: "; ?>
<?php		echo fecha_dma($row->fecha_inicial);?>
<?php		echo '<br>';?>
<?php  		echo "Fecha Final: "; ?>
<?php		echo fecha_dma($row->fecha_final);?>
<?php		echo '<br>';?>
<?php 	endforeach; ?>
</div>	
			
<div class="col-md-6">
	<?php $this->load->view('capturar/form', $options); ?>
</div>
			
	
	

	

