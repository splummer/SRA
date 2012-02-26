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
$start_date = array (
	'name'		=>	'start_date',
	'id'		=>	'start_date',
	'value' 	=>	set_value('start_date', isset($event['start_date'])),
	'class'		=>	'span2',
	'data-datepicker'	=>	'datepicker',
	'placeholder' =>	date('m/d/Y')
);
$start_time = array (
	'name'		=>	'start_time',
	'id'		=>	'start_time',
	'value' 	=>	set_value('start_time', isset($event['start_time'])),
	'class'		=>	'span1',
	'placeholder' =>	'1:00 pm'
);
$end_date = array (
	'name'		=>	'end_date',
	'id'		=>	'end_date',
	'value' 	=>	set_value('end_data', isset($event['end_date'])),
	'class'		=>	'span2',
	'data-datepicker'	=>	'datepicker',
	'placeholder' =>	date('m/d/Y')
);
$end_time = array (
	'name'		=>	'end_time',
	'id'		=>	'end_time',
	'value' 	=>	set_value('end_time', isset($event['end_time'])),
	'class'		=>	'span1',
	'placeholder' =>	'6:15 pm'
);


$form_label_param = array(
	'class'	=>	'control-label'
);

$form_attributes = array('class' => 'form-horizontal' );
?>

<?php echo validation_errors(); ?>

<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>

<fieldset>
	<legend>Basic Event Information</legend>
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
</fieldset>

<fieldset>
	<legend>Dates</legend>
	<div class="control-group">
		<?php echo form_label('Dates', 'Dates', $form_label_param); ?>
		<div class="controls form-inline">
			<?php
			echo form_input($start_date);
			echo form_input($start_time); ?>
			 to 
			<?php echo form_input($end_date);
			echo form_input($end_time);
			?>
		</div>
	</div> <!-- close "control-group" -->

</fieldset>

	<div class="form-actions">
		<?php echo form_submit('submit', 'Create Event', 'class="btn-primary"'); ?>
	</div>


<?php echo form_close(); ?>
