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
