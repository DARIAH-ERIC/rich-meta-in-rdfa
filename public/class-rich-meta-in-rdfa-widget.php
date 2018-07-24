<?php

class Rich_Meta_In_Rdfa_Widget extends WP_Widget {
	function __construct() {
		parent::__construct( 'rich_meta_in_rdfa_widget', __( 'Rich Meta in RDFa Widget', 'rich_meta_in_rdfa_domain' )
            , array(
			'description' => __( 'Rich meta in RDFa Widget', 'rich_meta_in_rdfa_domain' )
		) );
	}

	public function widget( $args, $instance ) {
	}

	/**
     * The form function is empty because we don't manage anything here
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
	}

	function rich_meta_in_rdfa_widget() {
		register_widget( 'rich_meta_in_rdfa_widget' );
	}
}

?>
