<?php 
	$championID = get_post_meta(get_the_ID() ,'champion', true);
	$splash_art = get_field_object('splash_art', $championID)['value'];

	$upload_dir = wp_upload_dir();
?>
<img class="build-header-bg" src="<?php echo $upload_dir['baseurl']; ?>/2015/11/<?php echo get_the_title($championID); ?>_0.jpg" alt="">
