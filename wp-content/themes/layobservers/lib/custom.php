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
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_use_theme_options', '__return_false' );
add_filter( 'ot_header_version_text', '__return_null' );
//load_template( trailingslashit( get_template_directory() ) . 'lib/theme-options.php' );
require_once (trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php');



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
 * Retrieve the current user's role.
 */
function get_current_user_role() {
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    return array_shift($roles);
}

/**
 * Create IMB editor role
 * The same as normal editor role, but with permission to edit theme options (so IMB can change menus)
 */
function add_imb_editor_role() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    if ($wp_roles->get_role('imb-editor')) {
        return true;
    }

    $editor = $wp_roles->get_role('editor');

    // Add a new role with editor caps
    $imb_editor = $wp_roles->add_role('imb-editor', 'IMB Editor', $editor->capabilities);
    $imb_editor->add_cap('edit_theme_options');
}
add_action('init', 'add_imb_editor_role');

/**
 * Remove unwanted Appearance submenu items when logged in with imb-editor role.
 */
function adjust_the_wp_menu() {
    if (get_current_user_role() == 'imb-editor') {
        remove_submenu_page( 'themes.php', 'widgets.php' );
        remove_submenu_page( 'themes.php', 'themes.php' );
    }
}
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );

/**
 * Remove widgets panel from Theme Customiser
 */
function imb_customizer($wp_customize) {
    if (get_current_user_role() == 'imb-editor') {
        $wp_customize->remove_panel('widgets');
    }
}
add_action('customize_register', 'imb_customizer');