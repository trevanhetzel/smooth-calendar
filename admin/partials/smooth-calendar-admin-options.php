<?php

/**
 * Provide the form for the settings page
 *
 * @link 		http://trevan.co
 * @since 		1.0.0
 *
 * @package 	Smooth_Calendar
 * @subpackage 	Smooth_Calendar/admin/partials
 */

?>

<form method="post" action="options.php">
	<?php settings_fields( 'calendar_group' ); ?>
	<?php do_settings_sections( 'calendar_group' ); ?>
	
	<label>Calendar permalink</label>
	<input type="text" name="calendar_setting_permalink" value="<?php echo get_option('calendar_setting_permalink'); ?>">
	
	<?php submit_button(); ?>
</form>