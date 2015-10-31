<?php 
	$items = get_field_object('end_items')['value'][0]['items'];
?>
<?php for ($i = 0; $i < count($items); $i++){ ?>
	<li><a href=""><?php echo get_the_post_thumbnail($items[$i]->ID) ?><span class="champ-name"><?php echo $items[$i]->post_title ?></span></a></li>
<?php } ?>