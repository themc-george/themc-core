<?php
//
// TheMC core code to support WPForms on TheMC.network
// (other than user activation, see new_user.php)
//

//
// we use wpforms as our registration and edit profile forms
// in some places we have meta data that we need to move 
// between the forms and WP...
//

// need to convert member_roles checkbox value(s) from multiline string to an array
// credit: https://wpforms.com/developers/how-to-store-checkbox-values-as-arrays-with-post-submissions/#related
// plugin code: apply_filters( 'wpforms_user_registration_process_registration_custom_meta_value', $value, $key, $id, $fields, $form_data );
function themc_wpf_user_meta_data( $field_value, $meta_key, $field_id, $fields, $form_data ) {

    if ( $meta_key === 'member_roles' ) {
        $field_value = explode( "\n", $field_value );
    }

    error_log( __FUNCTION__ . ' ' . $meta_key . ': ' . print_r( $field_value, true )  );

    return $field_value;
}
add_filter( 'wpforms_user_registration_process_registration_custom_meta_value', 'themc_wpf_user_meta_data', 10, 5);

// need to make the default message look better
// plugin code: return apply_filters( 'wpforms_user_registration_activation_activated_user_message', $message );
function themc_wpf_expired_activation( $message ) {
    error_log( __FUNCTION__ . ": expired activation");
    return( 'This activation link has expired. Please click to return to the <a href="/sign-in/">login page</a>.' );
}
add_filter( 'wpforms_user_registration_activation_activated_user_message', 'themc_expired_activation' );

