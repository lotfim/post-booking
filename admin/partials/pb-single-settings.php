<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 11/06/2019
 * Time: 18:07
 */

$price = get_post_meta($post->ID, self::PRICE_SETTING_META_KEY);
if (!$price) {
	$price = '';
}


?>
<label for="<?php echo esc_attr(self::PRICE_SETTING_META_KEY); ?>"> <?php _e('Price', $this->plugin_name); ?> </label>
<input id="<?php echo esc_attr(self::PRICE_SETTING_META_KEY); ?>" name="<?php echo esc_attr(self::PRICE_SETTING_META_KEY); ?>" type="number" min="0" value="<?php echo $price[0]; ?>" step="0.10">
