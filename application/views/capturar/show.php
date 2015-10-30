<div class="col-md-9">
	<div class="row">
	<?php $this->load->view('capturar/search'); ?>
	</div>
</div>
<div class="container">

	<div class="col-md-4">
			<?php $this->load->view('capturar/form', $empleado); ?>
	</div>

		
	<div id="showdata" class="col-md-7">
		<?php $this->load->view('capturar/ver_incidencias', $empleado); ?>
	</div>
	
</div>