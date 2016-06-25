<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              localhost
 * @since             1.0.0
 * @package           Handball4all
 *
 * @wordpress-plugin
 * Plugin Name:       handball4All
 * Plugin URI:        localhost
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Christopher Holden
 * Author URI:        localhost
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       handball4all
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-handball4all-activator.php
 */
function activate_handball4all() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-handball4all-activator.php';
	Handball4all_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-handball4all-deactivator.php
 */
function deactivate_handball4all() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-handball4all-deactivator.php';
	Handball4all_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_handball4all' );
register_deactivation_hook( __FILE__, 'deactivate_handball4all' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-handball4all.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_handball4all() {

	$plugin = new Handball4all();
	$plugin->run();

}
run_handball4all();
