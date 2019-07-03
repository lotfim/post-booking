<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 19/06/2019
 * Time: 15:00
 */
?>
<div class="wrap sgarc_form">
	<h2><?php echo get_admin_page_title(); ?></h2>
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
			<label for="<?php echo $this->plugin_name . '-' . self::STRIPE_PUBLIC_KEY; ?>"><?php echo _e('Stripe public API key', $this->plugin_name); ?>: &nbsp;</label>
			<input type="text" id="<?php echo $this->plugin_name . '-' . self::STRIPE_PUBLIC_KEY; ?>" size="90" name="<?php echo $this->plugin_name . '[' . self::STRIPE_PUBLIC_KEY . ']'; ?>" value="<?php echo esc_attr($settings[self::STRIPE_PUBLIC_KEY]); ?>"/>
		</fieldset>
		<br>

		<fieldset>
			<label for="<?php echo $this->plugin_name . '-' . self::STRIPE_PRIVATE_KEY; ?>"><?php echo _e('Stripe private API key', $this->plugin_name); ?>: &nbsp;</label>
			<input type="text" id="<?php echo $this->plugin_name . '-' . self::STRIPE_PRIVATE_KEY; ?>" size="90" name="<?php echo $this->plugin_name . '[' . self::STRIPE_PRIVATE_KEY . ']'; ?>" value="<?php echo esc_attr($settings[self::STRIPE_PRIVATE_KEY]); ?>"/>
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
		<br>


		<?php submit_button(); ?>
	</form>
</div>
