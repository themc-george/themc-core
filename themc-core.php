<?php
/*
Plugin Name:  TheMC Core Functionality
Plugin URI:   https://themc.network
Description:  Core code needed to operate themc.network
Version:      0.1
Author:       LinuxArchitect
Author URI:   https://linuxarchitect.themc.network
License:      GPLv3
License URI:  https://www.gnu.org/licenses/gpl-3.0.en.html
*/

// credit: Bill Erickson - https://www.billerickson.net/core-functionality-plugin

// Plugin directory
define( 'TheMC_CF' , plugin_dir_path( __FILE__ ) );

// TheMC.network is a multisite config with user tables shared with other site(s)
// when a user registers and activates on the main site, we need to give them role(s)
// on the core sites.
require_once( TheMC_CF . '/inc/new_user.php' );

// additional WPForms filters and actions
require_once( TheMC_CF . '/inc/wpforms.php' );

