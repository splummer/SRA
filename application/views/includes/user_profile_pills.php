<!-- TODO Would be cool to have messages dynamically displayed here -->

<ul class="pills">
	<?php echo ( uri_string() == 'user_profile' ) ? '<li class="active">' : '<li>' ; ?>
		<?php echo anchor('user_profile', 'Home') ; ?>
	</li>
	<?php echo ( uri_string() == 'user_profile/update' ) ? '<li class="active">' : '<li>' ; ?>
		<?php echo anchor('user_profile/update', 'Edit Profile') ; ?>
	</li>
	<li><a href="#">Messages</a></li>
	<li><a href="#">Settings</a></li>
	<li><a href="#">Contact</a></li>
	<?php echo ( uri_string() == 'auth/change_password' ) ? '<li class="active">' : '<li>' ; ?>
		<?php echo anchor('auth/change_password', 'Change Password') ; ?>
	</li>
</ul>
