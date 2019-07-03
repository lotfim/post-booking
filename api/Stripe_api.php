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

	public function charge_customer() {
		if ($this->create_customer()) {
			$this->charge();
		}
	}

	protected function create_customer() {
	}

	protected function charge() {
	}
}