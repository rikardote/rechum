<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SISSSTEMA</title>
<link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo site_url();?>assets/css/my_style.css">
<link rel="stylesheet" href="<?php echo site_url();?>assets/css/login.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<script src="<?php echo site_url();?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>	

</head>

<body class="mygradient">
	
</body>
</html>







<?php
$form = array(
	'class'=> 'form-signin'
);
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Numero de empleado',
	'class'=> 'form-control'
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'placeholder' => '******',
	'class'=> 'form-control'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);

 $attributes1=array(
            'class'=>'btn btn-lg btn-primary btn-block',
 );
?>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">


<?php echo form_open($this->uri->uri_string(),$form); ?>

<h3 class="form-signin-heading">Ingrese sus credenciales</h3>
<hr class="colorgraph"><br>

<table>
	<tr>
		<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><?php echo form_input($login); ?>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
		</div>
	</tr>
	<tr>
		<div class="input-group">
		
		<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><?php echo form_password($password); ?>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</div>
	</tr>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
		<?php echo $recaptcha_html; ?>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="3">
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php }
	} ?>

	
</table>
<br>
<?php echo form_submit('submit', 'Iniciar',$attributes1); ?>
<?php echo form_close(); ?>
					

    	</div>
</div>
					
				  
				</div>
			</div>
		  </div>

<script type="text/javascript">    
    $(window).load(function(){
        $('#login-modal').modal('show');
    });
</script>    
      



