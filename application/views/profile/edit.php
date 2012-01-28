<?php
$first_name = array (
	'name'		=>	'first_name',
	'id'		=>	'first_name',
	'value' 	=>	set_value('first_name', $user_profile['first_name']),
	'maxlength'	=>	'25',
	'class'		=>	'span4'
);
$last_name = array (
	'name'		=>	'last_name',
	'id'		=>	'last_name',
	'value' 	=>	set_value('last_name', $user_profile['last_name']),
	'maxlength'	=>	'25',
	'class'		=>	'span4'
);
$nickname = array (
	'name'		=>	'nickname',
	'id'		=>	'nickname',
	'value' 	=>	set_value('nickname', $user_profile['nickname']),
	'maxlength'	=>	'25',
	'class'		=>	'span4'
);
$address_1 = array (
	'name'		=>	'address_1',
	'id'		=>	'address_1',
	'value' 	=>	set_value('address_1', $user_profile['address_1']),
	'maxlength'	=>	'40',
	'class'		=>	'span4'
);
$address_2 = array (
	'name'		=>	'address_2',
	'id'		=>	'address_2',
	'value' 	=>	set_value('address_2', $user_profile['address_2']),
	'maxlength'	=>	'40',
	'class'		=>	'span4'
);
$city = array (
	'name'		=>	'city',
	'id'		=>	'city',
	'value' 	=>	set_value('city', $user_profile['city']),
	'maxlength'	=>	'30',
	'class'		=>	'span2'
);
//$state = array (
//	'name'		=>	'state',
//	'id'		=>	'state',
//	'class'		=>	'mediumSelect',
//);

?>


<!-- TODO replace this line with inline errors and color code form elements when errored -->
<?php echo validation_errors(); ?>

<?php echo form_open($this->uri->uri_string()); ?>

<div class=clearfix>
	<?php echo form_label('First Name', $first_name['id']); ?>
	<div class=input>
		<?php echo form_input($first_name) ?>
	</div>
</div> <!-- close clearfix -->
<div class=clearfix>
	<?php echo form_label('Last Name', $last_name['id']); ?>
	<div class=input>
		<?php echo form_input($last_name) ?>
	</div>
</div> <!-- close clearfix -->
<div class=clearfix>
	<?php echo form_label('Nickname', $nickname['id']); ?>
	<div class=input>
		<?php echo form_input($nickname) ?>
	</div>
</div> <!-- close clearfix -->
<div class=clearfix>
	<?php echo form_label('Address', $address_1['id']); ?>
	<div class=input>
		<?php echo form_input($address_1) ?> <br />
		<?php echo form_input($address_2) ?> <br />
		<div class=inline-inputs>
			<?php echo form_input($city) ?>
			<span class="help-block">City</span>
			<?php echo $this->load->view('includes/forms/states'); ?>
			<span class="help-block">State</span>
		</div>
	</div>
</div> <!-- close clearfix -->

<div class="clearfix">
	<div class="actions">
		<?php echo form_submit('submit', 'Update Profile', 'class="btn primary"'); ?>
	</div>
</div><!-- /clearfix -->
<?php echo form_close(); ?>
