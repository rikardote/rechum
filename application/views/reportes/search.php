<div class="col-xs-6 ">
    <?=form_open('reportes/search',array('class' => 'search-form', 'autocomplete' => 'off')); ?>
       <?php 	$search = array('name' => 'search','id' => 'search','value'=>'' );?>
         <div class="form-group has-feedback">
         	<label for="search" class="sr-only">Search</label>
         	<input type="text" class="form-control" name="search" id="search" placeholder="Num Empleado">
         	<span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
    <?=form_close(); ?>
</div>