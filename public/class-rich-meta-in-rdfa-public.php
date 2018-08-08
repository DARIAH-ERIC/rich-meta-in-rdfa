<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and the hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 * Also includes
 * @link       https://www.dariah.eu
 * @since      1.0.0
 * @package    Rich_Meta_In_Rdfa
 * @subpackage Rich_Meta_In_Rdfa/public
 * @author     Yoann Moranville <yoann.moranville@dariah.eu>
 */
class Rich_Meta_In_Rdfa_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rich-meta-in-rdfa-public.css', array(),
			$this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rich-meta-in-rdfa-public.js', array( 'jquery' )
			, $this->version, false );
	}

	/**
	 * Action to do when the html post page is created, so we can print the RDFa data needed.
	 *
	 * dc:identifier = link to OpenMethods
	 * dc:title = title of post
	 * dc:date = publication data on OpenMethods
	 * dc:description = introduction written by our editors (excerpt)
	 * dc:creator = the editor who wrote the introduction
	 * dc:source = Source link
	 * dc:subject = TaDiRAH categories
	 * dc:language = languages (also coming from the categories)
	 *
	 * @since    1.0.0
	 *
	 * @param $content String The WP Post data that will be displayed
	 */
	public function rmir_print_rdfa( $content ) {
		global $post;

		$rdfa = "<div style=\"display: none;\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
        $rdfa .= $this->create_meta_element("dc:identifier", get_permalink( $post->ID ) );
        $rdfa .= $this->create_meta_element("dc:title", $post->post_title );
        $rdfa .= $this->create_meta_element("dc:date", $post->post_date, false );
        $rdfa .= $this->create_meta_element("dc:description", $post->post_excerpt );
        $rdfa .= $this->create_meta_element("dc:creator", get_the_author_meta( "display_name", $post->post_author ) );
        $rdfa .= $this->create_meta_element("dc:source", get_post_meta( $post->ID, "item_link", true ) );
        $rdfa .= $this->create_meta_element("dc:type", "Blog post", false );

		$languageCategory = get_category_by_slug( "languages" );
		foreach( wp_get_post_categories( $post->ID ) as $category ) {
			$property = "dc:subject";
			if( $languageCategory && get_category( $category )->parent == $languageCategory->term_id ) {
				$property = "dc:language";
			}
			if( !$languageCategory || $category != $languageCategory->term_id ) {
                $rdfa .= $this->create_meta_element( $property, get_category( $category )->name );
			}
		}
		foreach( wp_get_post_tags( $post->ID ) as $tag ) {
            $rdfa .= $this->create_meta_element( "dc:subject", get_tag( $tag )->name );
        }
        $rdfa .= "</div>\n";
		return $rdfa . $content;
	}

    /**
     * Creates the HTML meta element given a property name and its content
     *
     * @param $property_name String The name of the property for the meta element
     * @param $content String The content of the meta element
     * @param bool $escape True if we should escape the content
     *
     * @return string The full meta element is returned (including the namespace used)
     */
	public function create_meta_element( $property_name, $content, $escape = true ) {
        if( $content != "") {
            return "<span property=\"" . $property_name . "\">" .
                   ( ( $escape ) ? htmlspecialchars( $content ) : $content ) . "</span>\n";
        }
        return "";
    }
}
