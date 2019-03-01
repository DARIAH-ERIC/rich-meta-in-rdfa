<?php
/**
 * Class TestClassRichMetaInRdfaPublic
 * Unit tests for the public-facing functionalities
 *
 * @package Rich_Meta_In_Rdfa/tests
 */

class Test_Rich_Meta_In_Rdfa_Public extends WP_UnitTestCase {

    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

    /**
     * A single example test.
     */
    function test_print_rdfa() {
        $author_name = 'yoann';
        $author_id = $this->factory->user->create( (array( 'user_login' => $author_name ) ) );
        $this->assertNotNull( $author_id );

        $title = 'This is my post title\'" - Ouh"';
        $post_id = $this->factory->post->create( array ( 'post_title' => $title, 'post_author' => $author_id ) );
        $this->assertNotNull( $post_id );

        $post = get_post( $post_id );
        $this->assertNotNull( $post );
        $this->assertEquals( $title, $post->post_title );
        $this->assertEquals( $author_name, get_the_author_meta( 'display_name', $post->post_author ) );
    }

    public function test_load_dependencies() {
        $plugin_directory = plugin_dir_path( dirname( __FILE__ ) );

        //admin
        $this->assertFileExists( $plugin_directory.'admin/class-rich-meta-in-rdfa-admin.php' );
        $this->assertFileExists( $plugin_directory.'admin/css/rich-meta-in-rdfa-admin.css' );
        $this->assertFileExists( $plugin_directory.'admin/js/rich-meta-in-rdfa-admin.js' );
        $this->assertFileExists( $plugin_directory.'admin/partials/rich-meta-in-rdfa-admin-display.php' );

        //includes
        $this->assertFileExists( $plugin_directory.'includes/class-rich-meta-in-rdfa.php' );
        $this->assertFileExists( $plugin_directory.'includes/class-rich-meta-in-rdfa-deactivator.php' );
        $this->assertFileExists( $plugin_directory.'includes/class-rich-meta-in-rdfa-activator.php' );
        $this->assertFileExists( $plugin_directory.'includes/class-rich-meta-in-rdfa-loader.php' );
        $this->assertFileExists( $plugin_directory.'includes/class-rich-meta-in-rdfa-i18n.php' );
    }

    public function test_define_admin_hooks() {
        $this->assertFalse( has_action( 'should_never_have_existed' ) );
        $this->assertTrue( has_filter( 'the_content' ) );
    }

    public function test_define_public_hooks() {
        $this->assertFalse( has_action( 'should_never_have_existed' ) );
        $this->assertTrue( has_filter( 'the_content' ) );
    }
}
