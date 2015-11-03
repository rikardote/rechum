<?php echo form_open('admin/addlist'); ?>
	<select size="30" class="form-control" name="listbox1[]"  multiple>"

	<?php foreach ($centros as $centro): ?>
	    echo "<option value="<?=$centro->id?>"><?php echo $centro->adscripcion.' - '.$centro->descripcion; ?></option>";
	 <?php endforeach; ?>
	 </select>
	 <?php echo form_submit('name', 'Guardar'); ?>
<?php echo form_close(); ?>