<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 03/07/2019
 * Time: 14:31
 */

class StripeApi {
	const CUSTOMER_CREATION_URL = 'https://api.stripe.com/v1/customers';
	const CHARGE_URL = 'https://api.stripe.com/v1/charges';

	protected $token;
	protected $private_key;
	protected $currency;
	protected $amount;
	protected $description;
	protected $email;
	protected $customer;

	public function __construct($token, $private_key, $amount, $currency, $description = '', $email = '') {
		$this->token       = $token;
		$this->private_key = $private_key;
		$this->amount      = $amount * 100.00;
		$this->currency    = $currency;
		$this->description = $description;
		$this->email       = $email;
	}

	public function charge_customer() {
		$customer = $this->create_customer();
		if ($customer) {
			$this->charge();
		}
	}

	protected function create_customer() {
		$data = ['source' => $this->token, 'description' => $this->description, 'email' => $this->email];
		$ch   = curl_init();
		curl_setopt_array(
			$ch,
			[
				CURLOPT_URL            => self::CUSTOMER_CREATION_URL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERPWD        => $this->private_key,
				CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
				CURLOPT_POSTFIELDS     => http_build_query($data),
			]
		);
		$response = json_decode(curl_exec($ch));
		if (isset($response->id)) {
			$this->customer = $response->id;

			return true;
		}

		return false;
	}

	protected function charge() {
		$data = ['amount' => $this->amount, 'currency' => $this->currency, 'customer' => $this->customer];
		$ch   = curl_init();
		curl_setopt_array(
			$ch,
			[
				CURLOPT_URL            => self::CHARGE_URL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERPWD        => $this->private_key,
				CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
				CURLOPT_POSTFIELDS     => http_build_query($data),
			]
		);
		$response = json_decode(curl_exec($ch));
		if ('succeeded' === $response->status) {
			return true;
		} else {
			return false;
		}
	}
}