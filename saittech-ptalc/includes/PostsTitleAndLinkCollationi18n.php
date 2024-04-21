<?php

/**
 * Define the internationalization functionality
 *
 * @link       https://sait.com.ng
 * @since      1.0.0
 *
 * @package    saittech-ptalc
 * @subpackage saittech-ptalc/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    saittech-ptalc
 * @subpackage saittech-ptalc/includes
 * @author     Samuel O <io@sait.com.ng>
 */

class PostsTitleAndLinkCollationi18n {
    /**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		\load_plugin_textdomain(
			'saittech-ptalc',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}