<?php

add_theme_support('post-thumbnails');
add_image_size('img_liste', 270, 220, array('center', 'top'));
add_image_size('icon_liste', 66, 66, true);

// Add javascript  
add_action('wp_footer', 'init_js');
function init_js() {
	wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-1.8.3.min.js');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.js');
    wp_enqueue_script( 'custom', get_template_directory_uri().'/js/script.js');
	wp_enqueue_script( 'script', get_template_directory_uri().'/js/ajax_script.js', array('jquery'), '1.0', true );

    if ( is_page_template( 'create-build.php' ) )
    {
        wp_enqueue_script( 'create-build', get_template_directory_uri().'/js/create-build.js', array('jquery'), '1.0', true );
        
        wp_localize_script('create-build', 'ajax_url', admin_url( 'admin-ajax.php' ) );
    }

	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
// add_action('wp_enqueue_scripts', 'add_js_scripts');

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
	        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
	        'has_archive' => true
	    )
	);
}


register_post_type( 'champion',
    array(
        'labels' => array(
            'name' => __('Champions'),
            'singular_name' => __('Champion')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);

register_post_type( 'champion_spell',
    array(
        'labels' => array(
            'name' => __('Champion spells'),
            'singular_name' => __('Champion spell')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);

/* Custom taxonomy */
register_taxonomy(
    'champ',
    'champion_spell',
    array(
        'label' => __('Champ'),
        'hierarchical' => true,
    )
);  

register_post_type( 'summoner_spell',
    array(
        'labels' => array(
            'name' => __('Summoner spells'),
            'singular_name' => __('Summoner spell')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);


register_post_type( 'item',
    array(
        'labels' => array(
            'name' => __('Items'),
            'singular_name' => __('Item')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);

/* Custom taxonomy */
register_taxonomy(
    'time',
    'item',
    array(
        'label' => __('Time'),
        'hierarchical' => true,
    )
);  

register_post_type( 'maitrise',
    array(
        'labels' => array(
            'name' => __('Maitrises'),
            'singular_name' => __('Maitrise')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);

/* Custom taxonomy */
register_taxonomy(
    'tree',
    'maitrise',
    array(
        'label' => __('Tree'),
        'hierarchical' => true,
    )
);   

register_post_type( 'rune',
    array(
        'labels' => array(
            'name' => __('Runes'),
            'singular_name' => __('Rune')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true
    )
);

/* Custom taxonomy */
register_taxonomy(
    'kind',
    'rune',
    array(
        'label' => __('Kind'),
        'hierarchical' => true,
    )
); 

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

add_action( 'wp_ajax_get_builds_ordered_by_date', 'get_builds_ordered_by_date' );
add_action( 'wp_ajax_nopriv_get_builds_ordered_by_date', 'get_builds_ordered_by_date' );

function get_builds_ordered_by_date() {
    $posts_per_page = $_POST['posts_per_page'];
    $offset = $_POST['offset'];
    $search = $_POST['search'];
    $args = array(
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'post_type' => 'build', 

    );
     

    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'template_archive_build' );
    endwhile;
    else :
        echo 'nothing found';
    endif;


    die();
}

add_action( 'wp_ajax_get_builds_ordered_by_likes', 'get_builds_ordered_by_likes' );
add_action( 'wp_ajax_nopriv_get_builds_ordered_by_likes', 'get_builds_ordered_by_likes' );
function get_builds_ordered_by_likes() {
    $posts_per_page = $_POST['posts_per_page'];
    $offset = $_POST['offset'];
    $search = $_POST['search'];
    $args = array(
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'post_type' => 'build', 
        'orderby'   => 'meta_value_num',
        'meta_key'  => 'likes',
    );
     

    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'template_archive_build' );
    endwhile;
    else :
        echo 'nothing found';
    endif;


    die();

}

add_action( 'wp_ajax_get_filtered_builds_ordered_by_date', 'get_filtered_builds_ordered_by_date' );
add_action( 'wp_ajax_nopriv_get_filtered_builds_ordered_by_date', 'get_filtered_builds_ordered_by_date' );
function get_filtered_builds_ordered_by_date() {
    $posts_per_page = $_POST['posts_per_page'];
    $offset = $_POST['offset'];
    $search = $_POST['search'];
    $championId = $_POST['championId'];
    $laneSlug = $_POST['laneId'];
    $roleSlug = $_POST['roleId'];
    $args = array(
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'post_type' => 'build', 
        'meta_query' => array(
        array(
            'key' => 'champion',
            'value' => '"' + $championId + '"',
            'compare' => '='
            )
        )
    );
     

    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'template_archive_build' );
    endwhile;
    else :
        echo 'nothing found';
    endif;


    die();

}


add_action( 'wp_ajax_get_filtered_builds_ordered_by_likes', 'get_filtered_builds_ordered_by_likes' );
add_action( 'wp_ajax_nopriv_get_filtered_builds_ordered_by_likes', 'get_filtered_builds_ordered_by_likes' );
function get_filtered_builds_ordered_by_likes() {
    $posts_per_page = $_POST['posts_per_page'];
    $offset = $_POST['offset'];
    $search = $_POST['search'];
    $championId = $_POST['championId'];
    $laneSlug = $_POST['laneId'];
    $roleSlug = $_POST['roleId'];
    $args = array(
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,

        'post_type' => 'build',
        'orderby'   => 'meta_value_num',
        'meta_key'  => 'likes',
         
        'meta_query' => array(
        array(
            'key' => 'champion',
            'value' => '"' + $championId + '"',
            'compare' => '='
            )
        ),
    );
     

    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'template_archive_build' );
    endwhile;
    else :
        echo 'nothing found';
    endif;


    die();
}

add_action( 'wp_ajax_get_number_filtered_builds', 'get_number_filtered_builds' );
add_action( 'wp_ajax_nopriv_get_number_filtered_builds', 'get_number_filtered_builds' );
function get_number_filtered_builds() {
	$posts_per_page = $_POST['posts_per_page'];
    $offset = $_POST['offset'];
    $orderby = $_POST['orderby'];
    $search = $_POST['search'];
    $championId = $_POST['championId'];
    $args = array(
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'post_type' => 'build', 
        'orderby' => $orderby,
        's' => $search,
        'meta_query' => array(
        array(
            'key' => 'champion',
            'value' => '"' + $championId + '"',
            'compare' => '='
            )
        )
    );
     
    $count_posts = 0;
    $ajax_query = new WP_Query($args);
    echo $ajax_query->found_posts;

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

add_action( 'wp_ajax_get_search_results', 'get_search_results' );
add_action( 'wp_ajax_nopriv_get_search_results', 'get_search_results' );
function get_search_results() {


    $search = $_POST['search'];
    $args = array(
        'post_type' => 'build', 

        's' => $search,
    );
     
    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'template_archive_build' );
    endwhile;
    endif;

    die();
}

function theme_queue_js(){
  if (!is_admin()){
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
      wp_enqueue_script( 'comment-reply' );
  }
}
add_action('get_header', 'theme_queue_js');

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="div-container">
        <?php echo get_avatar($comment,$size='48'); ?>
        <div class="custom-comment">
            <div class="comment-author vcard">
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
            <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
            </div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.') ?></em>
                    <br />
                <?php endif; ?>
            <div class="comment-text"><?php comment_text() ?></div> 
            <div class="reply">
                <?php
                    // Change 'max_depth' to $args['max_depth'] if you want to let the user directly change the number 
                    comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => 2))) 
                ?>
            </div>
        </div>
     </div>
    </li>
<?php
        }

add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}

// add_action('after_setup_theme', 'remove_admin_bar');
// function remove_admin_bar() {
//     if (!current_user_can('admin') && !is_admin()) {
//       show_admin_bar(false);
//     }
// }

add_action( 'wp_ajax_get_spells_pictures', 'get_spells_pictures' );
add_action( 'wp_ajax_nopriv_get_spells_pictures', 'get_spells_pictures' );
function get_spells_pictures() {
    $championId = $_POST['championId'];
    $args = array(
        'post_type' => 'champion', 
        'page_id' => $championId
    );

    $ajax_query = new WP_Query($args);
    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        $spell['q_spell'] = wp_get_attachment_url( get_post_thumbnail_id(get_field_object('q_spell')['value']->ID) );
        $spell['w_spell'] = wp_get_attachment_url( get_post_thumbnail_id(get_field_object('w_spell')['value']->ID) );
        $spell['e_spell'] = wp_get_attachment_url( get_post_thumbnail_id(get_field_object('e_spell')['value']->ID) );
        $spell['r_spell'] = wp_get_attachment_url( get_post_thumbnail_id(get_field_object('r_spell')['value']->ID) );
        $spell['passive'] = wp_get_attachment_url( get_post_thumbnail_id(get_field_object('passive')['value']->ID) );
    endwhile;
    endif;

    echo json_encode($spell);



    die();
}


?>