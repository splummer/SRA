<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'focused',
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or Username';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
$form_label_param = array(
	'class'	=>	'control-label'
);
?>
<div class="row-fluid">
	<div class="span2">
		&nbsp;
	</div>
	<div class="span10">
		<?php echo form_open($this->uri->uri_string() ); ?>
				<?php echo isset($errors[$login['name']]) || form_error($login['name']) ? '<div class="control-group error">' : '<div class="control-group">' ; ?>
					<?php echo form_label($login_label, $login['id'], $form_label_param); ?>
					<div class="controls">
						<?php echo form_input($login); ?>
						<?php echo form_error($login['name'], '<span class="help-inline">', '</span>') ; ?>
						<?php echo isset($errors[$login['name']]) ? '<span class="help-inline">' . $errors[$login['name']] . '</span>' : '' ; ?>
					</div>			
				</div><!-- /control-group-->
				<?php echo isset($errors[$password['name']]) || form_error($password['name']) ? '<div class="control-group error">' : '<div class="control-group">' ; ?>
					<?php echo form_label('Password', $password['id'], $form_label_param); ?>
					<div class="controls">
						<?php echo form_password($password); ?>
						<?php echo form_error($password['name'], '<span class="help-inline">', '</span>'); ?>
						<?php echo isset($errors[$password['name']])? '<span class="help-inline">' .  $errors[$password['name']] . '</span>' : '' ; ?>
					</div>
				</div><!-- /control-group-->
				<?php if ($show_captcha) { 
					if ($use_recaptcha) { ?>
						<div id="recaptcha_image"></div>
						<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
						<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
						<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
						<div class="recaptcha_only_if_image">Enter the words above</div>
						<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
						<controls type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
						<?php echo form_error('recaptcha_response_field'); ?>
						<?php echo $recaptcha_html; ?>
					<?php } else { ?>
						<div class="control-group">
							<div class="controls">
								<p>Enter the code exactly as it appears:</p>
								<?php echo $captcha_html; ?>
							</div>
						</div><!-- /control-group-->
						<?php $captch_error=form_error($captcha['name'], '<span class="help-inline">', '</span>') ; ?>
						<?php echo isset($captch_error) ? '<div class="control-group error">' : '<div class="control-group">' ; ?>
							<?php echo form_label('Confirmation Code', $captcha['id'], $form_label_param); ?>
								<div class="controls">
								<?php echo form_input($captcha); ?>
								<?php echo form_error($captcha['name'], '<span class="help-inline">', '</span>'); ?>
							</div>
						</div><!-- /control-group-->
						<?php }
					} ?>
				<div class=control-group>
					<?php echo form_label('Remember Me', $remember['id'], $form_label_param); ?>
					<div class="controls">
						<label class="checkbox inline">
							<?php echo form_checkbox($remember); ?>
						</label>
					</div>
				</div><!-- /control-group-->
				<div class="controls">
					<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
					<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>
				</div>
				<div class="control-group">
					<div class="actions">
					<?php echo form_submit('submit', 'Login', 'class="btn primary"'); ?>
					</div>
				</div><!-- /control-group -->
				<?php echo form_close(); ?>
		</div><!-- /span10 -->
</div><!-- /row-fluid -->
