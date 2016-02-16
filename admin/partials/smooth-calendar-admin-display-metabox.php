<?php

/**
 * Provide the view for a metabox
 *
 * @link 		http://trevan.co
 * @since 		1.0.0
 *
 * @package 	Smooth_Calendar
 * @subpackage 	Smooth_Calendar/admin/partials
 */

// Add a nonce field so we can check for it later.
wp_nonce_field( $this->plugin_name, 'calendar_meta_box_nonce' );

/*
* Use get_post_meta() to retrieve an existing value
* from the database and use the value for the form.
*/
$date_value = get_post_meta( $post->ID, 'meta_calendar_date', true );
$start_value = get_post_meta( $post->ID, 'meta_calendar_start', true );
$end_value = get_post_meta( $post->ID, 'meta_calendar_end', true );
$location_value = get_post_meta( $post->ID, 'meta_calendar_location', true );
$description_value = get_post_meta( $post->ID, 'meta_calendar_description', true );

?>

<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="calendar_date"><?php _e( 'Date', '' ); ?></label>
			</th>
			<td>
				<input type="date" name="calendar_date" id="calendar_date" value="<?php echo esc_attr( $date_value ); ?>" class="regular-text ltr">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="calendar_start"><?php _e( 'Start time', '' ); ?></label>
			</th>
			<td>
				<input type="text" name="calendar_start" id="calendar_start" value="<?php echo esc_attr( $start_value ); ?>" class="regular-text ltr">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="calendar_end"><?php _e( 'End time', '' ); ?></label>
			</th>
			<td>
				<input type="text" name="calendar_end" id="calendar_end" value="<?php echo esc_attr( $end_value ); ?>" class="regular-text ltr">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="calendar_location"><?php _e( 'Location', '' ); ?></label>
			</th>
			<td>
				<input type="text" name="calendar_location" id="calendar_location" value="<?php echo esc_attr( $location_value ); ?>" class="regular-text ltr">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="calendar_description"><?php _e( 'Description', '' ); ?></label>
			</th>
			<td>
				<?php wp_editor( $description_value, 'calendar_description' ); ?>
			</td>
		</tr>
	</tbody>
</table>
