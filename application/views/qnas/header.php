<!doctype html>
<html>
<head>
	
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" style="width:850px;">
	<tbody>
		<tr>
			<td><img alt="" src="<?=base_url()?>assets/images/issste.png" style="width: 400px; height: 108px;" /></td>
			<td align='right'>
			<p><strong>DELEGACION ESTATAL BAJA CALIFORNIA</strong></p>

			<p><strong>SUBDELEGACION DE ADMINISTRACION</strong></p>

			<p><strong>DEPARTAMENTO DE RECURSOS HUMANOS</strong></p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td><span style="font-size:14px;">CLAVE DE ADSCRIPCION: <strong><?=$reporte2->adscripcion?></strong></span></td>
			<td align='right'><span style="font-size:14px;">DESCRIPCION: <strong><?=$reporte2->descripcion?></strong></span></td>
		</tr>
		<tr>
			<td><span style="font-size:14px;">QNA: <strong><?php echo $reporte2->qna_mes.'/'.$reporte2->qna_year.' - '.$reporte2->qna_descripcion;?>  </strong></span></td>
			<td align='right'><span style="font-size:14px;">A&Ntilde;O: <strong><?=$reporte2->qna_year?></strong></span></td>
		</tr>
	</tbody>
</table>

<hr>
</body>
</html>
