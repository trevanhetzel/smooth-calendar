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

<div class="wrap">
	<h2>Smooth Calendar Settings</h2>

	<h3 class="title">Colors</h3>

	<form method="post" action="options.php">
		<?php settings_fields( 'calendar_group' ); ?>
		<?php do_settings_sections( 'calendar_group' ); ?>

		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="calendar_setting_header_bg">Header background</label></th>
					<td><input name="calendar_setting_header_bg" id="calendar_setting_header_bg" type="text" class="regular-text" value="<?php echo get_option('calendar_setting_header_bg'); ?>"></td>
				</tr>
				<tr>
					<th><label for="calendar_setting_days_bg">Days background</label></th>
					<td><input name="calendar_setting_days_bg" id="calendar_setting_days_bg" type="text" class="regular-text" value="<?php echo get_option('calendar_setting_days_bg'); ?>"></td>
				</tr>
				<tr>
					<th><label for="calendar_setting_link_bg">Link</label></th>
					<td><input name="calendar_setting_link_bg" id="calendar_setting_link_bg" type="text" class="regular-text" value="<?php echo get_option('calendar_setting_link_bg'); ?>"></td>
				</tr>
			</tbody>
		</table>
		
		<?php submit_button(); ?>
	</form>
</div>