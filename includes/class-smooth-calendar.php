<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://trevan.co
 * @since      1.0.0
 *
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/includes
 * @author     Trevan Hetzel <trevan@hetzelcreative.com>
 */
class Smooth_Calendar {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Smooth_Calendar_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'smooth-calendar';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Smooth_Calendar_Loader. Orchestrates the hooks of the plugin.
	 * - Smooth_Calendar_i18n. Defines internationalization functionality.
	 * - Smooth_Calendar_Admin. Defines all hooks for the admin area.
	 * - Smooth_Calendar_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-smooth-calendar-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-smooth-calendar-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-smooth-calendar-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-smooth-calendar-public.php';

		$this->loader = new Smooth_Calendar_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Smooth_Calendar_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Smooth_Calendar_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Smooth_Calendar_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'new_cpt_calendar' );

		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'calendar_add_metabox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'calendar_save_meta_box_data', 10, 2 );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'calendar_menu', 10, 2 );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'calendar_settings_init', 10, 2 );

		$this->loader->add_action( 'manage_calendar_posts_columns', $plugin_admin, 'calendar_columns_head');
		$this->loader->add_action( 'manage_calendar_posts_custom_column', $plugin_admin, 'calendar_columns_content', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Smooth_Calendar_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

		/**
		 * Expose extra meta values to API
		 */
		add_action( 'rest_api_init', 'calendar_register_meta' );

		function calendar_register_meta() {
			$meta_args = array(
				'get_callback'    => 'calendar_get_field',
				'update_callback' => null,
				'schema'          => null,
			);

			register_api_field( 'calendar', 'meta_calendar_date', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_start', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_end', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_location', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_description', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_month', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_year', $meta_args);
			register_api_field( 'calendar', 'meta_calendar_dateFormatted', $meta_args);
		}

		/**
		 * Get the value of meta field
		 */
		function calendar_get_field( $object, $field_name, $request ) {
		    return get_post_meta( $object[ 'id' ], $field_name, true );
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Smooth_Calendar_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
