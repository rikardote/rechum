
<table width="100%" border="0" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th>Num Empleado</th>
            <th>Nombre</th>
  
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sortedObjectArray as $empleado): ?>
        <tr data-toggle="collapse" data-target="#<?=$empleado->id?>" class="accordion-toggle">
		   <?php if ($empleado->conteo > 3 xor in_array($empleado->incidencia_cod, $inc)):	?>
		   <td><?=$empleado->num_empleado;?></td>	
		   <td><?=nombre_completo($empleado->nombres,$empleado->apellido_pat,$empleado->apellido_mat)?></td>
		</tr>	
	</tbody>
			<?php endif ?>
			
        </tr>
        <tr >
            <td colspan="6" class="hiddenRow">
            	<div class="accordian-body collapse" id="<?=$empleado->id?>"> 
            		<table class="table">
            			<tr>
	            			<th>Codigo</th>
	            		   	<th>Fecha Inicial</th>
                            <th>Fecha Final</th>
                            <th>Total</th>
            			</tr>
            			
            			<?php $incidencias = get_incidencias_sin_derecho2($empleado->empleado_id,$empleado->fecha_inicial,$empleado->fecha_final) ?>
            			
            				<?php foreach ($incidencias as $incidencia): ?>
                            <tr>
            				<td><?php echo $incidencia->incidencia_cod;?></td>
                            <td><?php echo fecha_dma($incidencia->fecha_inicial);?></td>
                            <td><?php echo fecha_dma($incidencia->fecha_final);?></td>
                            <td><?php echo $incidencia->conteo;?></td>
            		      </tr>		
            				<?php endforeach ?>
            		
            		</table>
            	</div> 
            </td>
        </tr>
        <?php endforeach ?>
       
    </tbody>
</table>
<script type="text/javascript">
	$('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');
});
</script>


