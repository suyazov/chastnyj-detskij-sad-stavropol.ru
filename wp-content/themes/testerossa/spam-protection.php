<?php
/**
 * Honeypot + timestamp spam protection for Contact Form 7
 * Replaces Google reCAPTCHA
 */

add_filter( 'wpcf7_form_elements', 'add_honeypot_and_timestamp_fields' );
function add_honeypot_and_timestamp_fields( $form ) {
    $honeypot = '<p class="hp-field" style="position:absolute;left:-9999px;"><label>Website: <input type="text" name="hp_website" autocomplete="off" tabindex="-1" /></label></p>';
    $timestamp = '<input type="hidden" name="form_start_time" value="' . time() . '" />';
    
    $form = str_replace( '<div class="cta__form">', '<div class="cta__form">' . $honeypot . $timestamp, $form );
    
    return $form;
}

add_filter( 'wpcf7_recaptcha_verify_response', '__return_true', 999 );
add_filter( 'wpcf7_validate' , 'validate_honeypot_and_time' , 20 , 2 );
function validate_honeypot_and_time( $result, $tags ) {
    $submission = WPCF7_Submission::get_instance();
    
    if ( ! $submission ) {
        return $result;
    }
    
    $honeypot = $submission->get_posted_data( 'hp_website' );
    if ( ! empty( $honeypot ) ) {
        $result->invalidate( 'hp_website', 'Spam detected' );
    }
    
    $start_time = $submission->get_posted_data( 'form_start_time' );
    if ( ! empty( $start_time ) && ( time() - intval( $start_time ) < 3 ) ) {
        $result->invalidate( 'form_start_time', 'Form submitted too quickly' );
    }
    
    return $result;
}
