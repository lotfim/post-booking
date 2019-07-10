<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 02/07/2019
 * Time: 14:55
 */
?>

<input type="hidden" id="pb_payment_failure_message" name="pb_payment_failure_message" value="<?php _e(esc_attr($paymentFailureMessage)); ?>"/>
<input type="hidden" id="pb_payment_button_text" name="pb_payment_button_text" value="<?php _e(esc_attr($paymentButtonText)); ?>"/>
<input type="hidden" id="pb_cvc_code_label" name="pb_cvc_code_label" value="<?php _e(esc_attr($cvcCodeLabel)); ?>"/>

<input type="hidden" id="pb_expiry_date_label" name="pb_expiry_date_label" value="<?php _e(esc_attr($expiryDateLabel)); ?>"/>

<input type="hidden" id="pb_full_name_label" name="pb_full_name_label" value="<?php _e(esc_attr($fullNameLabel)); ?>"/>
<input type="hidden" id="pb_card_number_label" name="pb_card_number_label" value="<?php _e(esc_attr($cardNumberLabel)); ?>"/>
<input type="hidden" id="pb_stripe_public_key" name="pb_stripe_public_key" value="<?php _e(esc_attr($stripePublicKey)); ?>"/>
<input type="hidden" id="pb_price" name="pb_price" value="<?php _e(esc_attr($price)); ?>"/>
<input type="hidden" id="pb_form_submit_url" name="pb_form_submit_url" value="<?php _e(esc_attr(get_permalink($post->ID))); ?>"/>

<input type="hidden" id="pb_month_placeholder" name="pb_month_placeholder" value="<?php _e('MM',$this->plugin_name); ?>"/>
<input type="hidden" id="pb_year_placeholder" name="pb_year_placeholder" value="<?php _e('YYYY',$this->plugin_name); ?>"/>
