<?php if($this->session->flashdata('errors')): ?>
<?php 	echo '<div class="alert alert-danger">'; ?>
<?php 	echo $this->session->flashdata('errors'); ?>
<?php 	echo "</div>"; ?>
<?php endif; ?>