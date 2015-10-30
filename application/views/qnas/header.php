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
			<p><h2><strong>DELEGACION ESTATAL BAJA CALIFORNIA</strong></h2></p>

			<p><h3><strong>SUBDELEGACION DE ADMINISTRACION</strong></h3></p>

			<p><h4><strong>DEPARTAMENTO DE RECURSOS HUMANOS</strong></h4></p>
			
			
			</td>
		</tr>
		<table border="0" cellpadding="1" cellspacing="1" style="width:500px;">
			<tbody>
				<tr>
					<p><td style="width: 100%; background-color: rgb(102, 102, 102);"><span style="color:#FFFFFF;">REPORTE DE CONTROL DE ASISTENCIA</span></td></p>
				</tr>
			</tbody>
		</table>

		<tr>
			<td><span style="font-size:16px;">CLAVE DE ADSCRIPCION: <strong><?=$reporte2->adscripcion?></strong></span></td>
			<td align='right'><span style="font-size:16px;">DESCRIPCION: <strong><?=$reporte2->descripcion?></strong></span></td>
		</tr>
		<tr>
			<td><span style="font-size:16px;">QNA: <strong><?php echo $reporte2->qna_mes.'/'.$reporte2->qna_year.' - '.$reporte2->qna_descripcion;?>  </strong></span></td>
			<td align='right'><span style="font-size:16px;">A&Ntilde;O: <strong><?=$reporte2->qna_year?></strong></span></td>
		</tr>
	</tbody>
</table>

<hr>
</body>
</html>
