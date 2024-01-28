<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://themeatelier.net/
 * @since             1.0.0
 * @package           Darkify
 *
 * @wordpress-plugin
 * Plugin Name:       Darkify
 * Plugin URI:        https://https://wp-plugins.themeatelier.net/
 * Description:       Darkify is for a stylish, modern darkmode look that people love.
 * Version:           1.0.1
 * Author:            ThemeAtelier
 * Author URI:        https://https://themeatelier.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       darkify
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DRK_LITE_VERSION', '1.0.1' );
define( 'DRK_LITE_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'DRK_LITE_BASENAME', plugin_basename(__FILE__) );
define( 'DRK_LITE_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-darkify-activator.php
 */
function darkify_activate() {
	require_once DRK_LITE_PATH . 'includes/class-darkify-activator.php';
	Darkify_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-darkify-deactivator.php
 */
function darkify_deactivate() {
	require_once DRK_LITE_PATH . 'includes/class-darkify-deactivator.php';
	Darkify_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'darkify_activate' );
register_deactivation_hook( __FILE__, 'darkify_deactivate' );

require DRK_LITE_PATH . 'includes/class-darkify.php';


function darkify_run() {
	$plugin = new Darkify();
	$plugin->run();
}
darkify_run();