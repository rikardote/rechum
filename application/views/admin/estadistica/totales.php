<table class="table table-bordered">
	<tr align="center">
		
		<td>10</td>
		<td>14</td>
		<td>17</td>
		<td>40</td>
		<td>41</td>
		<td>46</td>
		<td>47</td>
		<td>48</td>
		<td>49</td>
		<td>51</td>
		<td>53</td>
		<td>54</td>
		<td>55</td>
		<td>60</td>
		<td>62</td>
		<td>63</td>
		<td>94</td>
		<td>100</td>
        <td>Total</td>
		
	</tr>
	<tr align="center">
		
		<td><span class="badge"><?= $total_10; ?></span></td>
		<td><span class="badge"><?= $total_14; ?></span></td>
		<td><span class="badge"><?= $total_17; ?></span></td>
		<td><span class="badge"><?= $total_40; ?></span></td>
		<td><span class="badge"><?= $total_41; ?></span></td>
		<td><span class="badge"><?= $total_46; ?></span></td>
		<td><span class="badge"><?= $total_47; ?></span></td>
		<td><span class="badge"><?= $total_48; ?></span></td>
		<td><span class="badge"><?= $total_49; ?></span></td>
		<td><span class="badge"><?= $total_51; ?></span></td>
		<td><span class="badge"><?= $total_53; ?></span></td>
		<td><span class="badge"><?= $total_54; ?></span></td>
		<td><span class="badge"><?= $total_55; ?></span></td>
		<td><span class="badge"><?= $total_60; ?></span></td>
		<td><span class="badge"><?= $total_62; ?></span></td>
		<td><span class="badge"><?= $total_63; ?></span></td>
		<td><span class="badge"><?= $total_94; ?></span></td>
		<td><span class="badge"><?= $total_100;?></span></td>
        <td><span class="badge"><?= $total_10+$total_14+$total_17+$total_41+$total_40+$total_46+$total_47+$total_48+$total_49+
                                    $total_51+$total_53+$total_54+$total_55+$total_60+$total_62+$total_63+$total_94+$total_100;?>
            </span>
        </td>
		
	</tr>
</table>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        credits: {
            enabled: false
        },

        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                '10',
                '14',
                '17',
                '40',
                '41',
                '46',
                '47',
                '48',
                '49',
                '51',
                '53',
                '54',
                '55',
                '60',
                '62',
                '63',
                '94',
                '100',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Incidencias'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Total de Incidencias',
            data: [<?=$total_10?>,<?=$total_14?>,<?=$total_17?>, <?=$total_40?>, <?=$total_41?>, <?=$total_46?>, <?=$total_47?>, <?=$total_48?>, <?=$total_49?>, <?=$total_51?>, <?=$total_53?>, <?=$total_54?>, <?=$total_55?>, <?=$total_60?>, <?=$total_62?>, <?=$total_63?>, <?=$total_94?>, <?=$total_100?>]

      

        }]
    });
});
		</script>



<script src="<?php echo base_url()?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/js/highcharts-3d.js"></script>
<script src="<?php echo base_url()?>assets/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
<?php echo anchor('admin/'.$link_back, '<i class="fa fa-chevron-circle-left fa-2x"></i>'); ?>