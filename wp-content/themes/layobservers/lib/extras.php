<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('<span class="more-link">Read more ></span>', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/**
 * Unregister category and tag taxonomies.
 */
function unregister_categories_and_tags() {
  register_taxonomy('category', array());
  register_taxonomy('post_tag', array());
}
add_action('init', 'unregister_categories_and_tags');

/**
 * Remove Comments functionality
 */
// Removes from admin menu
function admin_menu_remove_comments() {
  remove_menu_page( 'edit-comments.php' );
}
add_action('admin_menu', 'admin_menu_remove_comments');

// Removes from post and pages
function init_remove_comments() {
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'init_remove_comments', 100);

// Removes from admin bar
function admin_bar_remove_comments() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_comments');

/**
 * Configure 'Reorder Posts' plugin
 */
// Override which post types to enable reordering on. Takes and returns an array of post types.
function reorder_override_post_types($post_types = array()) {
  return array('faq');
}
add_filter('metronet_reorder_post_types', 'reorder_override_post_types');

// Hide from WP admin
add_filter('metronet_reorder_post_allow_admin', '__return_false'); // Enable or disable the admin panel settings for the plugin
add_filter('metronet_reorder_allow_menu_order', '__return_false'); // Enable or disable the plugin's advanced menu_order modifications for all post types
add_filter('metronet_reorder_allow_menu_order_post', '__return_false'); // Enable or disable the plugin's advanced menu_order modifications for a single post type (format metronet_reorder_allow_menu_order_{post_type}) - If Filter metronet_reorder_allow_menu_order is false, there is no need for this filter
