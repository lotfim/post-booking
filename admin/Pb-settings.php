<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 11/06/2019
 * Time: 18:00
 */

class PbSettings {
	protected $price;
	protected $currency;
	protected $bookingTextButton;
	protected $plugin_name;

	const PRICE_SETTING_META_KEY = 'pb_price';
	const PRICE = 'pb_price';

	public function __construct($plugin_name) {
		$this->plugin_name = $plugin_name;
	}

	public function add_settings_box() {
		add_meta_box('booking-settings', __('Booking Setitngs', $this->plugin_name), array($this, 'displaySettings'), 'post');
	}

	/**
	 * @return mixed
	 */
	public function getPluginName() {
		return $this->plugin_name;
	}

	/**
	 * @param mixed $plugin_name
	 */
	public function setPluginName($plugin_name) {
		$this->plugin_name = $plugin_name;
	}

	public function completedSettings() {
		return (isset($this->price) && isset($this->currency) && isset($this->bookingTextButton));
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @return mixed
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @param mixed $currency
	 */
	public function setCurrency($currency) {
		$this->currency = $currency;
	}

	/**
	 * @return mixed
	 */
	public function getBookingTextButton() {
		return $this->bookingTextButton;
	}

	/**
	 * @param mixed $bookingTextButton
	 */
	public function setBookingTextButton($bookingTextButton) {
		$this->bookingTextButton = $bookingTextButton;
	}

	public function displaySettings($post) {
		include_once('partials' . DIRECTORY_SEPARATOR . 'pb-single-settings.php');
	}

	public function save_settings($post_id) {
		update_post_meta($post_id, self::PRICE, sanitize_text_field($_POST[self::PRICE_SETTING_META_KEY]));
		//register_post_meta();
	}

}