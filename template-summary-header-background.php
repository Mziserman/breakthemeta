<?php 
	$championID = get_post_meta(get_the_ID() ,'champion', true);
	$splash_art = get_field_object('splash_art', $championID)['value'];
?>
<img class="build-header-bg" src="<?php echo $splash_art['url']; ?>" alt="">
