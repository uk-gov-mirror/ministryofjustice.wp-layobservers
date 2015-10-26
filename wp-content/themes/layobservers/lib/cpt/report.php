<?php

function report_post_init() {
    $args = array(
      'public' => true,
      'label'  => 'Reports',
      'supports'      => array( 'title', 'thumbnail' ),
      'has_archive'   => true
    );
    register_post_type( 'report', $args );
}

add_action( 'init', 'report_post_init' );

function report_taxonomy() {
  	$args = array(
    	'hierarchical' => true
  	);
  register_taxonomy( 'report_year', 'report', $args );
}

add_action( 'init', 'report_taxonomy', 0 );
