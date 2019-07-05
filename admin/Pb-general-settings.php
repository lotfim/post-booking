<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 19/06/2019
 * Time: 14:31
 */

class PbGeneralSettings {
	protected $public_stripe_api_key;
	protected $private_stripe_api_key;
	protected $currency;
	protected $plugin_name;

	CONST STRIPE_PUBLIC_KEY = 'stripe_public_key';
	CONST STRIPE_PRIVATE_KEY = 'stripe_private_key';
	CONST CURRENCY = 'currency';

	public function __construct($plugin_name) {
		$this->plugin_name = $plugin_name;
	}


	public function create_settings_page() {
		add_options_page('Settings', __('Booking Settings', $this->plugin_name), 'manage_options', 'pb_settings', array($this, 'display_settings'));
	}

	public function save_settings() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	public function display_settings() {
		include_once('partials' . DIRECTORY_SEPARATOR . 'post-booking-general-settings.php');
	}

	public function validate($input) {
		$valid                           = array();
		$valid[self::STRIPE_PUBLIC_KEY]  = sanitize_text_field($input[self::STRIPE_PUBLIC_KEY]);
		$valid[self::STRIPE_PRIVATE_KEY] = sanitize_text_field($input[self::STRIPE_PRIVATE_KEY]);
		$valid[self::CURRENCY]           = sanitize_text_field($input[self::CURRENCY]);

		return $valid;
	}
}