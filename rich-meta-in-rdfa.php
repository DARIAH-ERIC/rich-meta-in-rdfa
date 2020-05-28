<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.dariah.eu/
 * @since             1.0.0
 * @package           Rich_Meta_In_Rdfa
 *
 * @wordpress-plugin
 * Plugin Name:       Rich Meta in RDFa Plugin
 * Plugin URI:        https://github.com/dariah-eric/rich-meta-in-rdfa
 * Description:       This plugin allows user to add RDFa into their posts.
 * Version:           1.2.6
 * Author:            Yoann
 * Author URI:        https://www.dariah.eu
 * License:           Apache License - 2.0
 * License URI:       http://www.apache.org/licenses/LICENSE-2.0
 * Text Domain:       rich-meta-in-rdfa
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'RICH_META_IN_RDFA_ROOT', dirname( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rich-meta-in-rdfa-activator.php
 */
function activate_rich_meta_in_rdfa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rich-meta-in-rdfa-activator.php';
	Rich_Meta_In_Rdfa_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rich-meta-in-rdfa-deactivator.php
 */
function deactivate_rich_meta_in_rdfa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rich-meta-in-rdfa-deactivator.php';
	Rich_Meta_In_Rdfa_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_rich_meta_in_rdfa' );
register_deactivation_hook( __FILE__, 'deactivate_rich_meta_in_rdfa' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rich-meta-in-rdfa.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rich_meta_in_rdfa() {
	$plugin = new Rich_Meta_In_Rdfa();
	$plugin->run();

    $rich_meta_in_rdfa_options = get_option( $plugin->get_plugin_name() );
    rmir_remove_json_api( $rich_meta_in_rdfa_options['keep_rel_link_head'] );
}

/**
 * To delete or keep the https://w.api.org rel attribute in link element (this gives an error to the plugin rdflib even
 * though it should now be allowed, see https://core.trac.wordpress.org/ticket/37841)
 *
 * @param $keep_rel_link_head bool If true, we will keep the link elements mentioned in the description
 * @since   1.0.0
 */
function rmir_remove_json_api( $keep_rel_link_head ) {
    if( ! $keep_rel_link_head ) {
        remove_action( 'template_redirect', 'rest_output_link_header' );
        remove_action( 'wp_head', 'rest_output_link_wp_head' );
    }
}

run_rich_meta_in_rdfa();
