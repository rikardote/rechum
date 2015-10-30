
<div id="vista" class="col-md-4">
	


<div class="col-md-8">
	<table class="table table-striped">
			<tr>
				<td>Quincena</td>
				<td>Ano</td>
				<td>Descripcion</td>
			</tr>
			<tr>
	<?php	foreach ($qnas as $qna): ?>
				<td><?php echo $qna->qna_mes;?></td>
				<td><?php echo $qna->qna_year;?></td>
				<td><?php echo $qna->qna_descripcion;?></td>
			</tr>
	<?php 	endforeach;?>
	</table>	
	</div>	
</div>