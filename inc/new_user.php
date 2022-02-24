<?php
//
// TheMC core code to support activating users on TheMC.network
//

define( 'THEMC_WPF_REG_ID', '101219' ); // wpf form number for user registration

// we use wpforms as our registration form
// wpforms takes care of creating the user and managing activation
// we just need to wake up and add a role for the user
// on each "core" site in our multisite network
// and on any independent site that shares our user table

// fires when member_registration form is completed...
function themc_wpf_member_registration( $fields, $entry, $form_data, $entry_id ) {

    error_log( __FUNCTION__ . ' hook called' );

}
add_action( 'wpforms_process_complete_' . THEMC_WPF_REG_ID, 'themc_wpf_member_registration', 10, 4 );

// plugin code: do_action( 'wpforms_user_registration_activation_user_activation_after', $user_id );
function themc_wpf_member_activation( $user_id ) {

    error_log( __FUNCTION__ . ' hook called' );

    $user = get_user_by('id', $user_id);

    if ( ! $user ) {
        error_log( __FUNCTION__ . ": user_id: " . $user_id . " not found?!?" );
        return;
    }

    //error_log( __FUNCTION__ . ": add role: subscriber" );
    //$user->add_role( "subscriber" );
}
add_action( 'wpforms_user_registration_activation_user_activation_after', 'themc_wpf_member_activation' );

