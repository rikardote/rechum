<p>Seleccione un centro, o varios presionando la tecla "CTRL" </p>

<?php echo form_open('admin/agregar_centro_a_usuario'); ?>
	
	<select size="30" class="form-control" name="listbox1[]"  multiple>"

	<?php foreach ($centros as $centro): ?>
	
	   <option <?php if (in_array($centro->id, $center)) {echo "selected";}  ?>  value="<?=$centro->id?>"><?php echo $centro->adscripcion.' - '.$centro->descripcion; ?></option>

	<?php endforeach; ?>
	</select>
	<?php echo form_submit('name', 'Guardar','class="btn btn-primary raised btn-sm btn-block"'); ?>
	<input type="hidden" name="user_id" value="<?=$user_id?>">
	
<?php echo form_close(); ?>

<pre><?php var_dump($center); ?></pre>