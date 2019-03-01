<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.dariah.eu
 * @since      1.0.0
 *
 * @package    Rich_Meta_In_Rdfa
 * @subpackage Rich_Meta_In_Rdfa/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<h2 class="nav-tab-wrapper">RDFa Settings</h2>

    <form method="post" name="rich_meta_in_rdfa_options" action="options.php">

		<?php
		//Grab all options
        $rich_meta_in_rdfa_options = get_option( $this->plugin_name );
        $keep_rel_link_head = $rich_meta_in_rdfa_options['keep_rel_link_head'];
        $create_sitemap_xml = $rich_meta_in_rdfa_options['create_sitemap_xml'];
        $intro_text = $rich_meta_in_rdfa_options['intro_text'];

        $html = "<tr>
                    <th scope=\"row\">
                        <label for=\"" . $this->plugin_name . "-keep-rel-link-head\">" . translate('Keep the link elements with weird rel attributes',
                $this->plugin_name) . "</label>
                    </th>
                    <td>
                        <input name=\"" . $this->plugin_name . "[keep_rel_link_head]\" id=\"" . $this->plugin_name
                        . "-keep-rel-link-head\" " . ( $keep_rel_link_head?"checked":"" ) . " type=\"checkbox\">
                    </td>
                </tr>";
        $html .= "<tr>
                    <th scope=\"row\">
                        <label for=\"" . $this->plugin_name . "-create-sitemap-xml\">" . translate('Create a sitemap with only the posts (rich-meta-in-rdfa.xml)',
                $this->plugin_name) . "</label>
                    </th>
                    <td>
                        <input name=\"" . $this->plugin_name . "[create_sitemap_xml]\" id=\"" . $this->plugin_name
                        . "-create-sitemap-xml\" " . ( $create_sitemap_xml?"checked":"" ) . " type=\"checkbox\">
                    </td>
                </tr>";
        $html .= "<tr>
                    <th scope=\"row\">
                        <label for=\"" . $this->plugin_name . "-intro-text\">" . translate('Create an introduction text for the title (i.e. \'OpenMethods introduction to: \')',
                $this->plugin_name) . "</label>
                    </th>
                    <td>
                        <input name=\"" . $this->plugin_name . "[intro_text]\" id=\"" . $this->plugin_name
                        . "-intro-text\" value=\"" . $intro_text . "\" type=\"text\">
                    </td>
                </tr>";

//		$options = get_option( $this->plugin_name . "_vocab", array() );
//		if( sizeof( $options ) == 0 ) {
//		    $options["key"] = "value";
//        }
//
//		$html = "";
//		$number = 0;
//		foreach( $options as $key => $value ) {
//            $html .= "<tr>
//                <td><input name=\"" . $this->plugin_name. "[key_" . $number . "]\" id=\"" . $this->plugin_name . "-" . $number . "_key\" value=\"" . $key . "\" class=\"regular-text\" type=\"text\"></td>
//                <td>
//                    <select name=\"" . $this->plugin_name. "[value_" . $number . "]\" id=\"" . $this->plugin_name . "-" . $number . "_value\">
//                        <option value=\"title\">Title</option>
//                        <option value=\"excerpt\">Excerpt</option>
//                        <option value=\"author\">Author</option>
//                    </select>
//                </td>
//            </tr>";
//            $number++;
//        }

		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
		?>

        <table class="form-table">
            <tbody>
                <?php echo $html; ?>
            </tbody>
        </table>

		<?php submit_button( __( 'Save all changes', $this->plugin_name ), 'primary','submit', TRUE ); ?>
	</form>

</div>
