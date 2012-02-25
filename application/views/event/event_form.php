<?php

$name = array (
	'name'		=>	'name',
	'id'		=>	'name',
	'value' 	=>	set_value('name', isset($event['name'])),
	'maxlength'	=>	'40',
	'class'		=>	'span3',
	'placeholder' =>	'Event Name'
);
$short_name = array (
	'name'		=>	'short_name',
	'id'		=>	'short_name',
	'value' 	=>	set_value('event_short_name', isset($event['short_name'])),
	'maxlength'	=>	'12',
	'class'		=>	'span3',
	'placeholder' =>	'Event Short Name'
);
$description = array (
	'name'		=>	'description',
	'id'		=>	'description',
	'value' 	=>	set_value('description', isset($event['description'])),
	'maxlength'	=>	'255',
	'class'		=>	'span4',
	'placeholder' =>	'Description'
);
$form_label_param = array(
	'class'	=>	'control-label'
);

$form_attributes = array('class' => 'form-horizontal' );
?>

<?php echo validation_errors(); ?>

<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>

<fieldset>
<div class="control-group">
	<?php echo form_label('Event Name', $name['id'], $form_label_param); ?>
	<div class="controls">
		<?php echo form_input($name) ?>
	</div>
</div> <!-- close "control-group" -->
<div class="control-group">
	<?php echo form_label('Event Short Name', $short_name['id'], $form_label_param); ?>
	<div class="controls">
		<?php echo form_input($short_name) ?>
		<p class="help-block">This will be used in the URL string. Use something short and easy to remember. i.e. RGXVII <br />
			Spaces will be replaced with underscores.
		</p>
	</div>
</div> <!-- close "control-group" -->

<div class="control-group">
	<?php echo form_label('Event Descirption', $description['id'], $form_label_param); ?>
	<div class="controls">
		<?php echo form_textarea($description) ?>
	</div>
</div> <!-- close "control-group" -->

	<div class="actions">
		<?php echo form_submit('submit', 'Create Event', 'class="btn-primary"'); ?>
	</div>
	
</fieldset>
<?php echo form_close(); ?>
