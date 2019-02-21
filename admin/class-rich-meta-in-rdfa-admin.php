<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://www.dariah.eu
 * @since      1.0.0
 *
 * @package    Rich_Meta_In_Rdfa
 * @subpackage Rich_Meta_In_Rdfa/admin
 * @author     Yoann <yoann.moranville@dariah.eu>
 */

class Rich_Meta_In_Rdfa_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rich_Meta_In_Rdfa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rich_Meta_In_Rdfa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rich-meta-in-rdfa-admin.css', array(), $this->version, 'all' );
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rich_Meta_In_Rdfa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rich_Meta_In_Rdfa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rich-meta-in-rdfa-admin.js', array( 'jquery' ),
            $this->version, false );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		add_options_page( 'RDFa Setup', 'RDFa', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page') );
	}
	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		/*
		 *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 */
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );
	}
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/rich-meta-in-rdfa-admin-display.php' );
	}
	/**
	 *  Save the plugin options
	 *
	 *
	 * @since    1.0.0
	 */
	public function options_update() {
		register_setting( $this->plugin_name, $this->plugin_name, array( 'sanitize_callback' => array( $this, 'validate' ), 'default' => array( 'keep_rel_link_head' => false, 'create_sitemap_xml' => false, 'intro_text' => '' ) ) );
	}
	/**
	 * Validate all options fields
	 *
	 * @since    1.0.0
	 */
	public function validate( $input ) {
		// All checkboxes inputs
		$valid = array();
        $valid['keep_rel_link_head'] = ( isset( $input['keep_rel_link_head'] ) && !empty( $input['keep_rel_link_head'] )
        ) ? true : false;
        $valid['create_sitemap_xml'] = ( isset( $input['create_sitemap_xml'] ) && !empty( $input['create_sitemap_xml'] )
        ) ? true : false;
        $valid['intro_text'] = (isset($input['intro_text']) && !empty($input['intro_text'])) ? sanitize_text_field($input['intro_text']) : '';
        return $valid;
	}
}
