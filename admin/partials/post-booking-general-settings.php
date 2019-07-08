<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 19/06/2019
 * Time: 15:00
 */
?>
<div class="wrap sgarc_form">
	<h2 style="font-weight: bold;"><?php echo get_admin_page_title(); ?></h2>
	<br><br>
	<form method="post" action="options.php">
		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		$settings = get_option($this->plugin_name);
		$currency = '';
		if (isset($settings) && isset($settings[self::CURRENCY])) {
			$currency = $settings[self::CURRENCY];
		}
		?>
		<fieldset>
			<legend style="font-weight: bold;margin-bottom: 15px;"><?php _e('Stripe settings', $this->plugin_name) ?></legend>
			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::STRIPE_PUBLIC_KEY); ?>"><?php echo _e('Stripe public API key', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::STRIPE_PUBLIC_KEY); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::STRIPE_PUBLIC_KEY . ']'); ?>" value="<?php echo esc_attr($settings[self::STRIPE_PUBLIC_KEY]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::STRIPE_PRIVATE_KEY); ?>"><?php echo _e('Stripe private API key', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::STRIPE_PRIVATE_KEY); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::STRIPE_PRIVATE_KEY . ']'); ?>" value="<?php echo esc_attr($settings[self::STRIPE_PRIVATE_KEY]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo $this->plugin_name . '-' . self::CURRENCY; ?>"><?php echo _e('Currency', $this->plugin_name); ?>: &nbsp;</label>
				<select id="<?php echo $this->plugin_name . '-' . self::CURRENCY; ?>" name="<?php echo $this->plugin_name . '[' . self::CURRENCY . ']'; ?>">
					<option value="eur" <?php if ('eur' === $currency) {
						echo esc_attr('selected');
					} ?>>€ &nbsp;
					</option>
					<option value="usd" <?php if ('usd' === $currency) {
						echo esc_attr('selected');
					} ?>>$ &nbsp;
					</option>
					<option value="gbp" <?php if ('gbp' === $currency) {
						echo esc_attr('selected');
					} ?>>£ &nbsp;
					</option>
				</select>
			</fieldset>
		</fieldset>
		<br><br>
		<fieldset>
			<legend style="font-weight: bold;margin-bottom: 15px;"><?php _e('Payment form settings', $this->plugin_name) ?></legend>
			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::FULL_NAME_LABEL); ?>"><?php echo _e('Full name label', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::FULL_NAME_LABEL); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::FULL_NAME_LABEL . ']'); ?>" value="<?php echo esc_attr($settings[self::FULL_NAME_LABEL]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::CARD_NUMBER_LABEL); ?>"><?php echo _e('Card number label', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::CARD_NUMBER_LABEL); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::CARD_NUMBER_LABEL . ']'); ?>" value="<?php echo esc_attr($settings[self::CARD_NUMBER_LABEL]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::EXPIRY_DATE_LABEL); ?>"><?php echo _e('Card expiry date label', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::EXPIRY_DATE_LABEL); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::EXPIRY_DATE_LABEL . ']'); ?>" value="<?php echo esc_attr($settings[self::EXPIRY_DATE_LABEL]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::CVC_CODE_LABEL); ?>"><?php echo _e('CVC code label', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::CVC_CODE_LABEL); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::CVC_CODE_LABEL . ']'); ?>" value="<?php echo esc_attr($settings[self::CVC_CODE_LABEL]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::SUCCESSFUL_PAYMENT_MESSAGE); ?>"><?php echo _e('Successful payment message', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::SUCCESSFUL_PAYMENT_MESSAGE); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::SUCCESSFUL_PAYMENT_MESSAGE . ']'); ?>" value="<?php echo esc_attr($settings[self::SUCCESSFUL_PAYMENT_MESSAGE]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::PAYMENT_FAILURE_MESSAGE); ?>"><?php echo _e('Payment failure message', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::PAYMENT_FAILURE_MESSAGE); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::PAYMENT_FAILURE_MESSAGE . ']'); ?>" value="<?php echo esc_attr($settings[self::PAYMENT_FAILURE_MESSAGE]); ?>"/>
			</fieldset>
			<br>

			<fieldset>
				<label for="<?php echo esc_attr($this->plugin_name . '-' . self::PAYMENT_BUTTON_TEXT); ?>"><?php echo _e('Payment button', $this->plugin_name); ?>: &nbsp;</label>
				<input type="text" id="<?php echo esc_attr($this->plugin_name . '-' . self::PAYMENT_BUTTON_TEXT); ?>" size="90" name="<?php echo esc_attr($this->plugin_name . '[' . self::PAYMENT_BUTTON_TEXT . ']'); ?>" value="<?php echo esc_attr($settings[self::PAYMENT_BUTTON_TEXT]); ?>"/>
			</fieldset>
			<br>
		</fieldset>

		<?php submit_button(); ?>
	</form>
</div>
