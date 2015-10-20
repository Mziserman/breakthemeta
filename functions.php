<?php

add_theme_support('post-thumbnails');
add_image_size('img_liste', 270, 220, array('center', 'top'));

// Add javascript  
add_action('wp_footer', 'init_js');
function init_js() {
	wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-1.8.3.min.js');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.js');
	wp_enqueue_script( 'custom', get_template_directory_uri().'/js/script.js');
}

add_action( 'init', 'create_post_type');
function create_post_type() {
	register_post_type( 'build',
		array(
			'labels' => array(
				'name' => __('Builds'),
				'singular_name' => __('Build')
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => true
		)
	);
}

/*Custom taxonomy*/
register_taxonomy(
	'lane',
	'build',
	array(
		'label' => __( 'lane' ),
		'hierarchical' => true,
	)
);
