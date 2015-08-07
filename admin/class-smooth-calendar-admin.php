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
		$opts['has_archive']							= true;
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

}
