<?php $this->load->view('includes/user_profile_pills'); ?>
<?php

// Make required fields have a required attribute to not waste the submitter's time.

$first_name = array (
	'name'		=>	'first_name',
	'id'		=>	'first_name',
	'value' 	=>	set_value('first_name', $user_profile['first_name']),
	'maxlength'	=>	'25',
	'class'		=>	'span4',
	'placeholder' =>	'First Name',
	'required' => 'required'
);
$last_name = array (
	'name'		=>	'last_name',
	'id'		=>	'last_name',
	'value' 	=>	set_value('last_name', $user_profile['last_name']),
	'maxlength'	=>	'25',
	'class'		=>	'span4',
	'placeholder' =>	'Last Name',
	'required' => 'required'
);
$nickname = array (
	'name'		=>	'nickname',
	'id'		=>	'nickname',
	'value' 	=>	set_value('nickname', $user_profile['nickname']),
	'maxlength'	=>	'25',
	'class'		=>	'span4',
	'placeholder' =>	'Nickname'
);
$address_1 = array (
	'name'		=>	'address_1',
	'id'		=>	'address_1',
	'value' 	=>	set_value('address_1', $user_profile['address_1']),
	'maxlength'	=>	'40',
	'class'		=>	'span4',
	'placeholder' =>	'Address'
);
$address_2 = array (
	'name'		=>	'address_2',
	'id'		=>	'address_2',
	'value' 	=>	set_value('address_2', $user_profile['address_2']),
	'maxlength'	=>	'40',
	'class'		=>	'span4',
	'placeholder' =>	'Address Line 2'
);
$city = array (
	'name'		=>	'city',
	'id'		=>	'city',
	'value' 	=>	set_value('city', $user_profile['city']),
	'maxlength'	=>	'30',
	'class'		=>	'span2',
	'placeholder' =>	'city'
);
$state_params = 'class=mediumSelect required=required' ; 
// Note that this won't act as required until we resolve having "null" as the value for the first/blank option.
$zip = array (
	'name'		=>	'zip',
	'id'		=>	'zip',
	'value' 	=>	set_value('zip', $user_profile['zip']),
	'maxlength'	=>	'5',
	'class'		=>	'span2',
	'placeholder' =>	'Zip Code'
);
$phone = array (
	'name'		=>	'phone',
	'id'		=>	'phone',
	'value' 	=>	set_value('phone', $user_profile['phone']),
	'maxlength'	=>	'12',
	'class'		=>	'span2',
	'placeholder' =>	'Phone Number'
);
$twitter = array (
	'name'		=>	'twitter',
	'id'		=>	'twitter',
	'value' 	=>	set_value('twitter', $user_profile['twitter']),
	'maxlength'	=>	'20',
	'class'		=>	'span2',
	'placeholder' =>	'Twitter Username'
);
$form_label_param = array(
	'class'	=>	'control-label'
);

?>


<!-- TODO replace this line with inline errors and color code form elements when errored 
	TODO probably should be a two column form with stacked labels perhaps -->

<?php echo validation_errors(); ?>

<?php echo form_open($this->uri->uri_string()); ?>

<div class=control-group>
	<?php echo form_label('First Name', $first_name['id'], $form_label_param); ?>
	<div class=input>
		<?php echo form_input($first_name) ?>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Last Name', $last_name['id'], $form_label_param); ?>
	<div class=input>
		<?php echo form_input($last_name) ?>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Nickname', $nickname['id'], $form_label_param); ?>
	<div class=input>
		<?php echo form_input($nickname) ?>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Address', $address_1['id'], $form_label_param); ?>
	<div class=input>
		<?php echo form_input($address_1) ?> <br />
		<?php echo form_input($address_2) ?> <br />
		<div class=inline-inputs>
			<?php echo form_input($city) ?>
			<?php echo state_dropdown('state', set_value('state', $user_profile['state']), $state_params); ?>
			<?php echo form_input($zip) ?>
		</div>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Country', 'country', $form_label_param); ?>
	<div class=input>
		<?php echo country_dropdown('country', '', set_value('country', $user_profile['country'])); ?>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Phone Number', $phone['id'], $form_label_param); ?>
	<div class=input>
		<?php echo form_input($phone) ?>
	</div>
</div> <!-- close control-group -->
<div class=control-group>
	<?php echo form_label('Twitter Username', $twitter['id'], $form_label_param); ?>
	<div class=input-prepend>
		<span class="add-on">@</span>
		<?php echo form_input($twitter) ?>
	</div>
</div> <!-- close control-group -->

<div class="control-group">
	<div class="actions">
		<?php echo form_submit('submit', 'Update Profile', 'class="btn-primary"'); ?>
	</div>
</div><!-- /control-group -->
<?php echo form_close(); ?>
