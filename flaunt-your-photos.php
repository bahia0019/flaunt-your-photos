<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://flauntyoursite.com
 * @since             1.0.0
 * @package           Flaunt_Your_Photos
 *
 * @wordpress-plugin
 * Plugin Name:       Flaunt Your Photos
 * Plugin URI:        https://flauntyoursite.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            William Bay
 * Author URI:        https://flauntyoursite.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flaunt-your-photos
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flaunt-your-photos-activator.php
 */
function activate_flaunt_your_photos() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-your-photos-activator.php';
	Flaunt_Your_Photos_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flaunt-your-photos-deactivator.php
 */
function deactivate_flaunt_your_photos() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-your-photos-deactivator.php';
	Flaunt_Your_Photos_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_flaunt_your_photos' );
register_deactivation_hook( __FILE__, 'deactivate_flaunt_your_photos' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-your-photos.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_flaunt_your_photos() {

	$plugin = new Flaunt_Your_Photos();
	$plugin->run();

}
run_flaunt_your_photos();
