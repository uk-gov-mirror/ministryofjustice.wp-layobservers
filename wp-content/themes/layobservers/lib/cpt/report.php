<?php

function report_post_init() {
    $args = array(
      'public' => true,
      'label'  => 'Reports',
      'supports'      => array( 'title' ),
      'has_archive'   => false,
      'publicly_queryable'  => false,
    );
    register_post_type( 'report', $args );
}

add_action( 'init', 'report_post_init' );
