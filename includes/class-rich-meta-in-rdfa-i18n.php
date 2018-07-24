<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rich_Meta_In_Rdfa
 * @subpackage Rich_Meta_In_Rdfa/includes
 * @author     Yoann <yoann.moranville@dariah.eu>
 */
class Rich_Meta_In_Rdfa_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'rich-meta-in-rdfa',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
