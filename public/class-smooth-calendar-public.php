<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://trevan.co
 * @since      1.0.0
 *
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smooth_Calendar
 * @subpackage Smooth_Calendar/public
 * @author     Trevan Hetzel <trevan@hetzelcreative.com>
 */
class Smooth_Calendar_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/smooth-calendar-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/smooth-calendar-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Creates new shortcodes
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	add_shortcode()
	 */
	public function register_shortcodes() {
		add_shortcode( 'smooth-calendar', array( $this, 'calendar_shortcode') );
	} // register_shortcodes()

	public function calendar_shortcode() {
		echo '<section class="smooth-cal" id="js-smooth-cal">test</section>';
	}

}
