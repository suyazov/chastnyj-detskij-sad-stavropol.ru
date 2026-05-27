<?php
/**
 * Honeypot + timestamp spam protection for Contact Form 7
 * Replaces Google reCAPTCHA
 */

// Add honeypot + timestamp fields BEFORE recaptcha field
add_filter( 'wpcf7_form_elements', 'add_honeypot_and_timestamp_fields' );
function add_honeypot_and_timestamp_fields( $form ) {
    $honeypot = '<p class="hp-field" style="position:absolute;left:-9999px;"><label>Don'\''t fill this: <input type="text" name="hp_website" /></label></p>';
    $timestamp = '<input type="hidden" name="form_start_time" value="' . time() . '" />';
    
    // Insert before _wpcf7_recaptcha_response field
    if ( strpos( $form, '_wpcf7_recaptcha_response' ) !== false ) {
        $form = str_replace( '<input type="hidden" name="_wpcf7_recaptcha_response"', $honeypot . $timestamp . '<input type="hidden" name="_wpcf7_recaptcha_response"', $form );
    }
    
    return $form;
}

// Remove reCAPTCHA validation - spam protection happens server-side
add_filter( 'wpcf7_recaptcha_verify_response', '__return_true', 999 );
add_filter( 'wpcf7_validate' , 'validate_honeypot_and_time' , 20 , 2 );
function validate_honeypot_and_time( $result, $tags ) {
    $submission = WPCF7_Submission::get_instance();
    
    // Check honeypot - reject if filled
    $honeypot = $submission->get_posted_data( 'hp_website' );
    if ( ! empty( $honeypot ) ) {
        $result['valid'] = false;
        $result['reason'] = array( 'hp_website' => 'Spam protection triggered' );
        return $result;
    }
    
    // Check timestamp - must be at least 3 seconds
    $start_time = $submission->get_posted_data( 'form_start_time' );
    if ( $start_time && ( time() - intval( $start_time ) < 3 ) ) {
        $result['valid'] = false;
        $result['reason'] = array( 'form_start_time' => 'Form submitted too quickly' );
        return $result;
    }
    
    return $result;
}
