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
	CONST FULL_NAME_LABEL = 'full_name_label';
	CONST CARD_NUMBER_LABEL = 'card_number_label';
	CONST EXPIRY_DATE_LABEL = 'expiry_date_label';
	CONST CVC_CODE_LABEL = 'cvc_code_label';
	CONST PAYMENT_BUTTON_TEXT = 'payment_button_text';
	CONST SUCCESSFUL_PAYMENT_MESSAGE = 'successful_payment_message';
	CONST PAYMENT_FAILURE_MESSAGE = 'payment_failure_message';


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
		$valid                                   = array();
		$valid[self::STRIPE_PUBLIC_KEY]          = sanitize_text_field($input[self::STRIPE_PUBLIC_KEY]);
		$valid[self::STRIPE_PRIVATE_KEY]         = sanitize_text_field($input[self::STRIPE_PRIVATE_KEY]);
		$valid[self::CURRENCY]                   = sanitize_text_field($input[self::CURRENCY]);
		$valid[self::FULL_NAME_LABEL]            = sanitize_text_field($input[self::FULL_NAME_LABEL]);
		$valid[self::CARD_NUMBER_LABEL]          = sanitize_text_field($input[self::CARD_NUMBER_LABEL]);
		$valid[self::EXPIRY_DATE_LABEL]          = sanitize_text_field($input[self::EXPIRY_DATE_LABEL]);
		$valid[self::CVC_CODE_LABEL]             = sanitize_text_field($input[self::CVC_CODE_LABEL]);
		$valid[self::PAYMENT_BUTTON_TEXT]    = sanitize_text_field($input[self::PAYMENT_BUTTON_TEXT]);
		$valid[self::SUCCESSFUL_PAYMENT_MESSAGE] = sanitize_text_field($input[self::SUCCESSFUL_PAYMENT_MESSAGE]);
		$valid[self::PAYMENT_FAILURE_MESSAGE]    = sanitize_text_field($input[self::PAYMENT_FAILURE_MESSAGE]);

		return $valid;
	}
}