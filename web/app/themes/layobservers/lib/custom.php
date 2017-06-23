<?php

/**
 * Custom functions
 */

//Load CPTs

function add_query_vars_filter($vars){
  $vars[] = "sort";
  $vars[] = "vs";
  return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');

$cpt_declarations = scandir( get_template_directory() . "/lib/cpt/" );
foreach ( $cpt_declarations as $cpt_declaration ) {
	if ( $cpt_declaration[0] != "." )
		require get_template_directory() . '/lib/cpt/' . $cpt_declaration;
}

// /* Get attachment ID from URL */
function get_attachment_id_from_src( $image_src ) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var( $query );
	return $id;
}

/**
 * Meta Boxes
 */
load_template( trailingslashit( get_template_directory() ) . 'lib/meta-boxes.php' );

/* Setup option tree */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_use_theme_options', '__return_true' );
add_filter( 'ot_header_version_text', '__return_null' );

/* Display child pages on parent page  */

function wpb_list_child_pages() {

global $post;

$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

if ( $childpages ) {

	$string = '<ul class="child-list">' . $childpages . '</ul>';
}

echo $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

/**
 * Hide editor on homepage.
 *
 */
add_action('init', 'remove_editor_init');
function remove_editor_init() {
    // if post not set, just return
    // fix when post not set, throws PHP's undefined index warning
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    } else {
        return;
    }
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
    if ($template_file == 'page-home.php') {
        remove_post_type_support('page', 'editor');
    }
}
