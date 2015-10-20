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
	// __ traduisible
	register_post_type( 'projet',
		array(
			'labels' => array(
				'name' => __('Projets'),
				'singular_name' => __('Projet')
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => true
		)
	);
	register_post_type( 'film',
		array(
			'labels' => array(
				'name' => __('Films'),
				'singular_name' => __('Film')
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
			'has_archive' => false
		)
	);
	register_post_type( 'acteur',
		array(
			'labels' => array(
				'name' => __('Acteurs'),
				'singular_name' => __('Acteur')
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
			'has_archive' => false
		)
	);
}

/*Custom taxonomy*/
register_taxonomy(
	'type',
	'projet',
	array(
		'label' => __( 'type' ),
		'hierarchical' => true,
	)
);

/*Custom taxonomy*/
register_taxonomy(
	'sujet',
	'film',
	array(
		'label' => __( 'Sujet' ),
		'hierarchical' => true,
	)
);