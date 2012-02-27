<!-- TODO Would be cool to have messages dynamically displayed here -->

<ul class="nav nav-tabs">
	<?php echo ( uri_string() == "event/index/$event_id" ) ? '<li class="active">' :
			 uri_string() == "event/index/$short_name" ? '<li class="active">' : '<li>' ; ?>
		<?php echo anchor("event/index/$short_name", 'Event Info') ; ?>
	</li>
	<li><a href="#">Time Slots</a></li>
	<li><a href="#">Stuff</a></li>
	<li><a href="#">Other Stuff</a></li>
</ul>
