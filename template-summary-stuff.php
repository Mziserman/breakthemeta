<?php 
	$items = get_field_object('end_items')['value'];
?>
<?php for ($i = 0; $i < count($items); $i++){ ?>
	<li><a href=""><?php echo get_the_post_thumbnail($items[$i]['items'][0]->ID) ?><span class="champ-name"><?php echo $items[$i]['items'][0]->post_title ?></span></a></li>
<?php } ?>