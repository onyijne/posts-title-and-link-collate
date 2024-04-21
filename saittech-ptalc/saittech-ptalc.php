<?php

/*
    Posts Title And Link Collation - tool to collate all posts titles and their respective links for a period.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/*
Plugin Name: Posts Title And Link Collation 
Plugin URI: https://github.com/saittec/posts-title-and-link-collate
Version: 1.0.0
Author: Samuel O
Author URI: https://sait.com.ng
*/

//disallow access if the ABSPATH global is not defined
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'SAITTECH_PTALC_VERSION', '1.0.0' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/SaitPostsTitleAndLinkCollationActivator.php
 */
function activate_saittech_ptalc() {
	require_once \plugin_dir_path( __FILE__ ) . 'includes/PostsTitleAndLinkCollationActivator.php';
	PostsTitleAndLinkCollationActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/PostsTitleAndLinkCollationDeactivator.php
 */
function deactivate_saittech_ptalc() {
	require_once \plugin_dir_path( __FILE__ ) . 'includes/PostsTitleAndLinkCollationDeactivator.php';
	PostsTitleAndLinkCollationDeactivator::deactivate();
}

\register_activation_hook( __FILE__, 'activate_saittech_ptalc' );
\register_deactivation_hook( __FILE__, 'deactivate_saittech_ptalc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require \plugin_dir_path( __FILE__ ) . 'includes/PostsTitleAndLinkCollation.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_saittech_ptalc() {

	$plugin = new PostsTitleAndLinkCollation();
	$plugin->run();

}
run_plugin_saittech_ptalc();