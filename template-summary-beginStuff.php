<?php 
	$starter = get_field_object('starter_item')['value'][0]['items'];
?>
<?php for ($i = 0; $i < count($starter); $i++) { ?>
	<li><a href=""><?php echo get_the_post_thumbnail($starter[$i]->ID) ?><span class="champ-name"><?php echo $starter[$i]->post_title; ?></span></a></li>
<?php } ?>