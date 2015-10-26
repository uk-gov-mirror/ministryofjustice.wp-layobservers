<?php

function faq_post_init() {
    $args = array(
      'public' => true,
      'label'  => 'FAQs',
      'supports'      => array( 'title', 'editor' ),
      'has_archive'   => true
    );
    register_post_type( 'faq', $args );
}

add_action( 'init', 'faq_post_init' );

function faq_taxonomy() {
  	$args = array(
    	'hierarchical' => true
  	);
  register_taxonomy( 'faq_year', 'faq', $args );
}

add_action( 'init', 'faq_taxonomy', 0 );
