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

	<form method="post" action="options.php">
		<?php settings_fields( 'calendar_group' ); ?>
		<?php do_settings_sections( 'calendar_group' ); ?>

		<h3 class="title">Colors</h3>

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

		<h3 class="title">Single pages for events</h3>

		<p>Select this option if you want each event to have its own single page. This will give each event its own unique URL that you can link directly to. It will also display a link on each event to view the full single page (and will truncate the description on the calendar view).</p>

		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="calendar_setting_header_bg">Enable single pages</label></th>
					<?php
					$singleVal = get_option('calendar_setting_single');
					?>
					<td><input name="calendar_setting_single" id="calendar_setting_single" type="checkbox" <?php if ($singleVal) { ?>checked<?php } ?>></td>
				</tr>
			</tbody>
		</table>

		<h3 class="title">Google Calendar link</h3>

		<p>Select this option if you want to display a hyperlink on single event pages that allows users to add the event to their Google Calendar.</p>

		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="calendar_setting_header_bg">Enable Google Calendar link</label></th>
					<?php
					$gcalVal = get_option('calendar_setting_gcal');
					?>
					<td><input name="calendar_setting_gcal" id="calendar_setting_gcal" type="checkbox" <?php if ($gcalVal) { ?>checked<?php } ?>></td>
				</tr>
			</tbody>
		</table>

		<?php submit_button(); ?>
	</form>
</div>
