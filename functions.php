<?php

add_theme_support('post-thumbnails');
add_image_size('img_liste', 270, 220, array('center', 'top'));

// Add javascript  
add_action('wp_footer', 'init_js');
function init_js() {
	wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-1.8.3.min.js');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.js');
	wp_enqueue_script( 'custom', get_template_directory_uri().'/js/script.js');
	wp_enqueue_script( 'script', get_template_directory_uri().'/js/ajax_script.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action('wp_enqueue_scripts', 'add_js_scripts');

//Custom post
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
register_taxonomy(
	'champion',
	'build',
	array(
		'label' => __( 'champion' ),
		'hierarchical' => true,
	)
);
register_taxonomy(
	'role',
	'build',
	array(
		'label' => __( 'role' ),
		'hierarchical' => true,
	)
);

add_action( 'wp_ajax_get_builds', 'get_builds' );
add_action( 'wp_ajax_nopriv_get_builds', 'get_builds' );

function get_builds() {
	$posts_per_page = $_POST['posts_per_page'];
	$offset = $_POST['offset'];
	$orderby = $_POST['orderby'];
	$args = array(
		'posts_per_page' => $posts_per_page,
		'offset' => $offset,
	    'post_type' => 'build', 
	    'orderby' => $orderby
	);

	$ajax_query = new WP_Query($args);
	if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
		get_template_part( 'template_archive_build' );
	endwhile;
	endif;


	die();

}
add_action( 'wp_ajax_get_number_of_builds', 'get_number_of_builds' );
add_action( 'wp_ajax_nopriv_get_number_of_builds', 'get_number_of_builds' );

function get_number_of_builds() {
	$count_posts = wp_count_posts('build');

	$published_posts = $count_posts->publish;
	echo $published_posts;

	die();

}
