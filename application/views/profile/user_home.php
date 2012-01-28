<?php $this->load->view('includes/user_profile_pills'); ?>
<div class="row">
	<div class="span8">
		<address>
		<strong><?php echo $user_profile['first_name'] . ' ' . $user_profile['last_name'] ; ?> </strong>
		<?php echo ( !empty($user_profile['nickname'])) ? '"' . $user_profile['nickname'] .'"' : '' ; ?>
		<br />
		<?php echo ( !empty($user_profile['address_1']) ) ? $user_profile['address_1'] . '<br />' : '' ; ?>
		<?php echo ( !empty($user_profile['address_2']) ) ? $user_profile['address_2'] . '<br />' : '' ; ?>

		<?php echo ( !empty($user_profile['city']) ) ? $user_profile['city'] . ', ' : '' ; ?>
		<?php echo ( !empty($user_profile['state']) ) ? $user_profile['state'] . ' ' : '' ; ?>
		<?php echo ( !empty($user_profile['zip']) ) ? $user_profile['zip'] : '' ; ?>
		<?php echo ( !empty($user_profile['city']) || !empty($user_profile['state']) || !empty($user_profile['zip'])) ? '<br />' : '' ; ?>

		<?php echo ( !empty($user_profile['country']) ) ? $user_profile['country'] . '<br />' : '' ; ?>

		<?php echo ( !empty($user_profile['phone']) ) ? '<abbrv title="Phone"><strong>P: </strong></abbrv>' . 
			$user_profile['phone'] . '<br />' : '' ; ?>

		<?php echo ( !empty($user_profile['twitter']) ) ? '<a href="http://twitter.com/' . $user_profile['twitter'] .
			 '">' . $user_profile['twitter'] . '</a><br />' : '' ; ?>

		<?php echo ( !empty($user_profile['website']) ) ? '<a href="' . $user_profile['website'] .
			 '">' . $user_profile['website'] . '</a><br />' : '' ; ?>

		</address>
	</div>
</div>