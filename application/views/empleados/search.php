<div class="col-xs-6 ">
    <?=form_open('empleados/search',array('class' => 'search-form')); ?>
       <?php 	$search = array('name' => 'search','id' => 'search','value'=>'' );?>
         <div class="form-group has-feedback">
         	<label for="search" class="sr-only">Search</label>
         	<input type="text" class="form-control" name="search" id="search" placeholder="Num Empleado o Apellido">
         	<span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
    <?=form_close(); ?>
</div>