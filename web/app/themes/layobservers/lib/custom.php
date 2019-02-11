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

/**
 * Get attachment ID from its URL
 *
 * @param string $url
 * @return bool|int The Attachment ID or false if not found
 */
function get_attachment_id_from_src($url) {
	if (($pos = strpos($url, '/uploads/')) === false) {
		// URL does not contain /uploads/, so we won't be able to find an ID
		return false;
	}

	// Drop everything up to (and including) /uploads/ in the URL
	// e.g. "http://example.com/wp-content/uploads/2017/06/file.pdf"
	//      => "2017/06/file.pdf"
	$url_part = substr($url, $pos + strlen('/uploads/'));

	$query = new WP_Query([
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'meta_key' => '_wp_attached_file',
		'meta_value' => $url_part,
		'posts_per_page' => 1,
		'fields' => 'ids',
	]);

	return ($query->post_count > 0) ? (int) $query->posts[0] : false;
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

/**
 * Get the current version of WP
 *
 * This is provided for external resources to resolve the current wp_version
 *
 * @return string
 */
function moj_wp_version()
{
  global $wp_version;

  return $wp_version;
}

add_action('rest_api_init', function () {
  register_rest_route('moj', '/version', array(
    'methods' => 'GET',
    'callback' => 'moj_wp_version'
  ));
});
