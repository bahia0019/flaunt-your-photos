<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://flauntyoursite.com
 * @since      1.0.0
 *
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/includes
 * @author     William Bay <william@flauntyoursite.com>
 */
class Flaunt_Your_Photos_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'flaunt-your-photos',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
