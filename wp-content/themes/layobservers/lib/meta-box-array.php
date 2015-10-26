<?php

// Array hold all meta-boxes - slug param is custom to control which page it appears on
$meta_boxes = array(
	array(
		'id' => 'homepage_meta_box',
		'title' => 'Homepage Options',
		'slug' => 'home',
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'id' => 'welcome-title',
				'label' => 'Welcome title',
				'type' => 'text',
				'desc' => 'Main title on homepage, underneath banner'
			),
			array(
				'id' => 'welcome-text',
				'label' => 'Welcome text',
				'type' => 'textarea-simple',
				'desc' => 'Intro text on homepage, underneath main title'
			),
			array(
				'id' => 'welcome-link',
				'label' => 'Learn more link destination',
				'type' => 'page-select',
				'desc' => 'Please select the destination page for Learn more link'
			),
			array(
				'id' => 'banner-tab',
				'label' => 'Banner',
				'type' => 'tab'
			),
			array(
				'id' => 'banner_heading',
				'label' => 'Banner heading',
				'type' => 'text',
				'desc' => 'Main heading in banner area'
			),
			array(
				'id' => 'banner-sub-heading',
				'label' => 'Banner sub-heading',
				'type' => 'text',
				'desc' => 'Sub-heading in banner area'
			),
			array(
				'id' => 'banner-link',
				'label' => 'Banner link',
				'type' => 'text',
				'desc' => 'The destination for the link in the banner'
			),
			array(
				'id' => 'banner-image',
				'label' => 'Banner image - 940px x 306px',
				'type' => 'upload',
				'desc' => 'The background image for the banner. Must be 940px x 306px.'
			),
			array(
				'id' => 'quick-links-tab',
				'label' => 'Quick links',
				'type' => 'tab'
			),
			array(
				'id' => 'quick-link-1',
				'label' => 'Quick link 1 text',
				'type' => 'text',
				'desc' => 'Text to display for the first quick link'
			),
			array(
				'id' => 'quick-link-1-page',
				'label' => 'Quick link 1 destination',
				'type' => 'page-select',
				'desc' => 'Please select the destination page for the first link'
			),
			array(
				'id' => 'quick-link-2',
				'label' => 'Quick link 2 text',
				'type' => 'text',
				'desc' => 'Text to display for the second quick link'
			),
			array(
				'id' => 'quick-link-2-page',
				'label' => 'Quick link 2 destination',
				'type' => 'page-select',
				'desc' => 'Please select the destination page for the second link'
			),
			array(
				'id' => 'quick-link-3',
				'label' => 'Quick link 3 text',
				'type' => 'text',
				'desc' => 'Text to display for the third quick link'
			),
			array(
				'id' => 'quick-link-3-page',
				'label' => 'Quick link 3 destination',
				'type' => 'page-select',
				'desc' => 'Please select the destination page for the third link'
			),
			array(
				'id' => 'quick-link-4',
				'label' => 'Quick link 4 text',
				'type' => 'text',
				'desc' => 'Text to display for the fourth quick link'
			),
			array(
				'id' => 'quick-link-4-page',
				'label' => 'Quick link 4 destination',
				'type' => 'page-select',
				'desc' => 'Please select the destination page for the fourth link'
			),
			array(
				'id' => 'sidebar-text-tab',
				'label' => 'Sidebar text',
				'type' => 'tab'
			),
			array(
				'id' => 'sidebar-text-title',
				'label' => 'Sidebar text title',
				'type' => 'text',
				'desc' => 'Sidebar title'
			),
			array(
				'id' => 'sidebar-text-p1',
				'label' => 'Sidebar text first para',
				'type' => 'textarea-simple',
				'desc' => 'First paragraph of sidebar body text'
			),
			array(
				'id' => 'sidebar-text-p2',
				'label' => 'Sidebar text second para',
				'type' => 'textarea-simple',
				'desc' => 'Second paragraph of sidebar body text'
			),
			array(
				'id' => 'sidebar-link',
				'label' => 'Sidebar link',
				'type' => 'page-select',
				'desc' => 'Link under sidebar text'
			),
			array(
				'id' => 'related-links',
				'label' => 'Related links',
				'type' => 'tab'
			),
			array(
				'id' => 'related-1',
				'label' => 'Related link 1 text',
				'type' => 'text',
				'desc' => 'Text to display for the first quick link'
			),
			array(
				'id' => 'related-link-1',
				'label' => 'Related link 1 URL',
				'type' => 'text',
				'desc' => 'The destination for the first related link'
			),
			array(
				'id' => 'related-2',
				'label' => 'Related link 2 text',
				'type' => 'text',
				'desc' => 'Text to display for the second quick link'
			),
			array(
				'id' => 'related-link-2',
				'label' => 'Related link 2 URL',
				'type' => 'text',
				'desc' => 'The destination for the second related link'
			),
			array(
				'id' => 'related-3',
				'label' => 'Related link 3 text',
				'type' => 'text',
				'desc' => 'Text to display for the third quick link'
			),
			array(
				'id' => 'related-link-3',
				'label' => 'Related link 3 URL',
				'type' => 'text',
				'desc' => 'The destination for the third related link'
			),
			array(
				'id' => 'related-4',
				'label' => 'Related link 4 text',
				'type' => 'text',
				'desc' => 'Text to display for the fourth quick link'
			),
			array(
				'id' => 'related-link-4',
				'label' => 'Related link 4 URL',
				'type' => 'text',
				'desc' => 'The destination for the fourth related link'
			),
			array(
				'id' => 'home-video-tab',
				'label' => 'Homepage video',
				'type' => 'tab'
			),
			array(
				'id' => 'home-video',
				'label' => 'Homepage video',
				'type' => 'text',
				'desc' => 'The URL for the youtube video on the homepage'
			)
		)
	),

array(
	'id' => 'reports-upload-box',
	'title' => 'Reports upload box',
	//'slug' => 'report',
	'pages' => array( 'report' ),
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
		array(
			'id' => 'report-upload',
			'label' => 'PDF upload',
			'type' => 'upload',
			'desc' => 'Upload PDF version of report'
		)
	)
),

array(
	'id' => 'jobs',
	'title' => 'Jobs',
	//'slug' => 'report',
	'pages' => array( 'job' ),
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
		array(
			'id' => 'description',
			'label' => 'Description',
			'type' => 'textarea-simple',
			'desc' => ''
		),
		array(
			'id' => 'time-commitment',
			'label' => 'Time commitment',
			'type' => 'text',
			'desc' => ''
		),
		array(
			'id' => 'rcr',
			'label' => 'Recruitment Campaign Reference',
			'type' => 'text',
			'desc' => ''
		),
		array(
			'id' => 'closing-date',
			'label' => 'Closing Date',
			'type' => 'date-picker',
			'desc' => ''
		),
	)
),

);


if( function_exists('register_field_group') ):

register_field_group(array (
	'key' => 'group_553f8f4ba3227',
	'title' => 'Vacany Map',
	'fields' => array (
		array (
			'key' => 'field_553f8f672ac4f',
			'label' => 'Map',
			'name' => 'map',
			'prefix' => '',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'job',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;
