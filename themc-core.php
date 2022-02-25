<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress or ClassicPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://linuxarchitect.themc.network
 * @since             0.0.1
 * @package           Themc_Core
 *
 * @wordpress-plugin
 * Plugin Name:       TheMC Core
 * Plugin URI:        https://themc.network/about/website-info/plugins/
 * Description:       Core code needed to operate themc.network
 * Version:           0.0.1
 * Author:            LinuxArchitect
 * Requires at least: 5.9.0
 * Requires PHP:      8.0.0
 * Tested up to:      5.9.1
 * Author URI:        https://linuxarchitect.themc.network/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       themc-core
 * Domain Path:       /languages
 */

//
// Move all non-theme code needed to operate our site to this core functionality plugin
// This plugin is probably only useful on the main multisite site of themc.network
//
// credit: Bill Erickson - https://www.billerickson.net/core-functionality-plugin
// credit: https://github.com/TukuToi/better-wp-plugin-boilerplate
//

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'THEMC_CORE_VERSION', '0.0.1' );

/**
 * Define the Plugin basename
 */
define( 'THEMC_CORE_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 *
 * This action is documented in includes/class-themc-core-activator.php
 * Full security checks are performed inside the class.
 */
function themc_core_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-themc-core-activator.php';
	Themc_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 *
 * This action is documented in includes/class-themc-core-deactivator.php
 * Full security checks are performed inside the class.
 */
function themc_core_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-themc-core-deactivator.php';
	Themc_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'themc_core_activate' );
register_deactivation_hook( __FILE__, 'themc_core_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-themc-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Generally you will want to hook this function, instead of callign it globally.
 * However since the purpose of your plugin is not known until you write it, we include the function globally.
 *
 * @since    0.0.1
 */
function themc_core_run() {

	$plugin = new Themc_Core();
	$plugin->run();

}
themc_core_run();
