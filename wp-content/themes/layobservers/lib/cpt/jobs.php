<?php

function job_post_init() {
    $args = array(
      'public' => true,
      'label'  => 'Current Vacancies',
      'supports'      => array( 'title', 'thumbnail' ),
      'has_archive'   => true,
      'rewrite' => array(
        'slug' => 'job'
      )
    );
    register_post_type( 'job', $args );
}

add_action( 'init', 'job_post_init' );

/*function job_taxonomy() {
    $args = array(
      'hierarchical' => true,
      'label' => __( 'Prison' ),
    );
  register_taxonomy( 'prison', 'job', $args );
}

add_action( 'init', 'job_taxonomy', 0 );
*/
