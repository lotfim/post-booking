<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 02/07/2019
 * Time: 14:55
 */
?>

<input type="hidden" id="pb_stripe_public_key" name="pb_stripe_public_key" value="<?php _e(esc_attr($stripePublicKey)); ?>"/>
<input type="hidden" id="pb_price" name="pb_price" value="<?php _e(esc_attr($price)); ?>"/>
<input type="hidden" id="pb_form_submit_url" name="pb_form_submit_url" value="<?php _e(esc_attr(get_permalink($post->ID))); ?>"/>