<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://lotmantech.com
 * @since      1.0.0
 *
 * @package    Post_Booking
 * @subpackage Post_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Booking
 * @subpackage Post_Booking/admin
 * @author     LotMan Tech <contact@lotmantech.com>
 */
require_once plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR . 'Pb-settings.php';
require_once plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR . 'Pb-general-settings.php';
require_once plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR . 'Pb-bookings.php';
require_once plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR . 'Pb-delivered-bookings.php';


class Post_Booking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	protected $settings;

	protected $general_settings;

	protected $bookings;

	protected $delivered_bookings;

	/**
	 * @return mixed
	 */
	public function getGeneralSettings() {
		return $this->general_settings;
	}

	/**
	 * @param mixed $general_settings
	 */
	public function setGeneralSettings($general_settings) {
		$this->general_settings = $general_settings;
	}

	/**
	 * @return mixed
	 */
	public function getSettings() {
		return $this->settings;
	}

	public function __construct($plugin_name, $version) {

		$this->plugin_name      = $plugin_name;
		$this->version          = $version;
		$this->settings         = new PbSettings($this->plugin_name);
		$this->general_settings = new PbGeneralSettings($this->plugin_name);
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
		 * defined in Post_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/post-booking-admin.css', array(), $this->version, 'all');
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
		 * defined in Post_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/post-booking-admin.js', array('jquery'), $this->version, false);
	}

	public function bookings_page() {
		add_menu_page(__('Bookings', $this->plugin_name), __('Bookings', $this->plugin_name), 'edit_posts', 'display_bookings', array($this, 'display_bookings'));
	}

	public function delivered_bookings_page() {
		add_menu_page(__('Delivered bookings', $this->plugin_name), __('Delivered bookings', $this->plugin_name), 'edit_posts', 'display_delivered_bookings', array($this, 'display_delivered_bookings'));
	}

	public function display_bookings() {
		echo '<div class="wrap"><h2>' . __('Bookings', $this->plugin_name) . '</h2>';
		$this->bookings = new PbBookings(array(), $this->plugin_name);
		$this->bookings->prepare_items();
		$this->bookings->display();
		echo '</div>';
	}

	public function display_delivered_bookings() {
		echo '<div class="wrap"><h2>' . __('Delivered bookings', $this->plugin_name) . '</h2>';
		$this->bookings = new PbDeliveredBookings(array(), $this->plugin_name);
		$this->bookings->prepare_items();
		$this->bookings->display();
		echo '</div>';
	}
}
