<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://trevan.co
 * @since      1.0.0
 *
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/admin
 * @author     Trevan Hetzel <trevan@hetzelcreative.com>
 */
class Smooth_Calendar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Smooth_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Smooth_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/smooth-calendar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Smooth_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Smooth_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/smooth-calendar-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Creates a new custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public function new_cpt_calendar() {
		$cap_type 	= 'post';
		$plural 	= 'Calendar';
		$single 	= 'Calendar';
		$cpt_name 	= 'calendar';

		$opts['can_export']								= true;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= false;
		$opts['has_archive']							= false;
		$opts['hierarchical']							= false;
		$opts['map_meta_cap']							= true;
		$opts['menu_icon']								= 'dashicons-admin-post';
		$opts['menu_position']							= 25;
		$opts['public']									= true;
		$opts['publicly_querable']						= true;
		$opts['query_var']								= true;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= false;
		$opts['show_in_admin_bar']						= true;
		$opts['show_in_menu']							= true;
		$opts['show_in_nav_menu']						= true;
		$opts['show_ui']								= true;
		$opts['supports']								= array( 'title' );
		$opts['taxonomies']								= array();
		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";
		$opts['labels']['add_new']						= __( "Add New Event", 'calendar' );
		$opts['labels']['add_new_item']					= __( "Add New Event", 'calendar' );
		$opts['labels']['all_items']					= __( "Events", 'calendar' );
		$opts['labels']['edit_item']					= __( "Edit event" , 'calendar' );
		$opts['labels']['menu_name']					= __( $plural, 'calendar' );
		$opts['labels']['name']							= __( $plural, 'calendar' );
		$opts['labels']['name_admin_bar']				= __( $single, 'calendar' );
		$opts['labels']['new_item']						= __( "New event", 'calendar' );
		$opts['labels']['not_found']					= __( "No events found", 'calendar' );
		$opts['labels']['not_found_in_trash']			= __( "No events found in Trash", 'calendar' );
		$opts['labels']['parent_item_colon']			= __( "Parent {$plural} :", 'calendar' );
		$opts['labels']['search_items']					= __( "Search {$plural}", 'calendar' );
		$opts['labels']['singular_name']				= __( $single, 'calendar' );
		$opts['labels']['view_item']					= __( "View {$single}", 'calendar' );
		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= false;
		$opts['rewrite']['pages']						= true;
		$opts['rewrite']['slug']						= __( strtolower( $plural ), 'calendar' );
		$opts['rewrite']['with_front']					= false;
		$opts = apply_filters( 'calendar-cpt-options', $opts );
		register_post_type( strtolower( $cpt_name ), $opts );
	} // new_cpt_calendar()

	/**
	 * [calendar_add_metabox description]
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function calendar_add_metabox() {
		add_meta_box(
			'calendar_section',
			__( 'Event details', 'calendar_textdomain' ),
			array( $this, 'calendar_meta_box_callback' ),
			'calendar',
			'normal',
			'default'
		);
	} // calendar_add_metabox()

	/**
	 * [calendar_meta_box_callback description]
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return [type] [description]
	 */
	public function calendar_meta_box_callback( $post ) {
		include( plugin_dir_path( __FILE__ ) . 'partials/smooth-calendar-admin-display-metabox.php' );
	} // calendar_meta_box_callback()

	/**
	 * Saves metabox data
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function calendar_save_meta_box_data( $post_id ) {

		if ( ! isset( $_POST['calendar_meta_box_nonce'] ) ) { return; }
		if ( ! wp_verify_nonce( $_POST['calendar_meta_box_nonce'], $this->plugin_name ) ) { return; }
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( ! current_user_can( 'edit_page', $post_id ) ) { return $post_id; }

		// Sanitize user input.
		$date_data = sanitize_text_field( $_POST['calendar_date'] );
		$start_data = sanitize_text_field( $_POST['calendar_start'] );
		$end_data = sanitize_text_field( $_POST['calendar_end'] );
		$location_data = sanitize_text_field( $_POST['calendar_location'] );
		$description_data = sanitize_text_field( $_POST['calendar_description'] );

		// Add month & year
		$date = esc_attr( $date_data );
		$month = date('m', strtotime($date));
		$monthText = date('M', strtotime($date));
		$day = date('j', strtotime($date));
		$year = date('Y', strtotime($date));
		$formatted_date = $monthText . ' ' . $day . ', ' . $year;

		// Update the meta field in the database.
		update_post_meta( $post_id, 'meta_calendar_date', $date_data );
		update_post_meta( $post_id, 'meta_calendar_start', $start_data );
		update_post_meta( $post_id, 'meta_calendar_end', $end_data );
		update_post_meta( $post_id, 'meta_calendar_location', $location_data );
		update_post_meta( $post_id, 'meta_calendar_description', $description_data );
		update_post_meta( $post_id, 'meta_calendar_month', $month );
		update_post_meta( $post_id, 'meta_calendar_year', $year );
		update_post_meta( $post_id, 'meta_calendar_dateFormatted', $formatted_date );


	} // calendar_save_meta_box_data()

	/**
	 * Creates menu page
	 *
	 * @since 	1.0.0
	 * @return 	void
	 */
	function calendar_menu() {
		add_options_page( 'Smooth Calendar Options', 'Smooth Calendar', 'manage_options', 'smooth-calendar', 'calendar_options' );

		function calendar_options() {
			if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}

			include( plugin_dir_path( __FILE__ ) . 'partials/smooth-calendar-admin-options.php' );
		} // calendar_options()
	} // calendar_menu()

	/**
	 * Inits settings fields
	 *
	 * @since 	1.0.0
	 * @return 	void
	 */
	function calendar_settings_init() {
		register_setting('calendar_group','calendar_setting_header_bg');
		register_setting('calendar_group','calendar_setting_days_bg');
		register_setting('calendar_group','calendar_setting_text_bg');
		register_setting('calendar_group','calendar_setting_link_bg');
	} // calendar_settings_init()

}
