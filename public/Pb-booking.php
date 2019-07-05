<?php

/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 19/06/2019
 * Time: 16:01
 */
require_once plugin_dir_path(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'Pb-settings.php';
require_once plugin_dir_path(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'Pb-general-settings.php';
require_once plugin_dir_path(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'Stripe_api.php';


class PbBooking {
	protected $plugin_name;

	public function __construct($plugin_name) {
		$this->plugin_name = $plugin_name;
	}

	public function booking_button($content) {
		global $post;
		$stripePrivateKey = get_option($this->plugin_name)[PbGeneralSettings::STRIPE_PRIVATE_KEY];
		$stripePublicKey  = get_option($this->plugin_name)[PbGeneralSettings::STRIPE_PUBLIC_KEY];
		$currency         = get_option($this->plugin_name)[PbGeneralSettings::CURRENCY];
		$price            = get_post_meta($post->ID, PbSettings::PRICE_SETTING_META_KEY)[0];
		$validSettigs     = ($stripePrivateKey && '' !== $stripePrivateKey) && ($stripePublicKey && '' !== $stripePublicKey) && ($currency && '' !== $currency) && ($price && '' !== $price && 0.0 < $price);

		if (is_single() && $validSettigs) {
			include_once('partials' . DIRECTORY_SEPARATOR . 'pb-booking-form-information.php');
			$content .= '<button onclick="displayBookingSpace();">' . __('Book', $this->plugin_name) . '</button> <div id="booking-space"></div>';
		}

		return $content;
	}

	public function register_booking($content) {
		global $post;
		$stripePrivateKey = get_option($this->plugin_name)[PbGeneralSettings::STRIPE_PRIVATE_KEY];
		$price            = get_post_meta($post->ID, PbSettings::PRICE_SETTING_META_KEY)[0];
		$currency         = get_option($this->plugin_name)[PbGeneralSettings::CURRENCY];
		$fullName         = sanitize_text_field($_POST['full-name']);
		$validSettigs     = ($stripePrivateKey && '' !== $stripePrivateKey) && ($currency && '' !== $currency) && ($price && '' !== $price && 0.0 < $price);
		if (isset($_POST['stripeToken']) && $validSettigs) {
			$stripeToken = sanitize_text_field($_POST['stripeToken']);
			$stripe_api  = new StripeApi($stripeToken, $stripePrivateKey, $price, $currency, 'desc', 'test@yopmail.com');
			$payment     = $stripe_api->charge_customer();
			if ($payment) {
				//TODO Registering the order
				add_post_meta($post->ID, 'order', ['used' => false, 'name' => $fullName], false);

				$content .= '<p>Votre commande a été prise en compte </p>';
			}
		}

		return $content;
	}

	private function register_payment() {
		global $post;
		$stripePrivateKey = get_option($this->plugin_name)[PbGeneralSettings::STRIPE_PRIVATE_KEY];
		$price            = get_post_meta($post->ID, PbSettings::PRICE_SETTING_META_KEY)[0];
		$currency         = get_option($this->plugin_name)[PbGeneralSettings::CURRENCY];
		$validSettigs     = ($stripePrivateKey && '' !== $stripePrivateKey) && ($currency && '' !== $currency) && ($price && '' !== $price && 0.0 < $price);
		if (isset($_POST['stripeToken']) && $validSettigs) {
			$stripeToken = sanitize_text_field($_POST['stripeToken']);
			$stripe_api  = new StripeApi($stripeToken, $stripePrivateKey, $price, $currency, 'desc', 'test@yopmail.com');

			return $stripe_api->charge_customer();
		}

		return false;
	}
}