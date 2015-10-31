<?php 
	$items = get_field_object('end_items')['value'][0]['items'];
?>
<?php for ($i = 0; $i < count($items); $i++){ ?>
	<li><?php echo get_the_post_thumbnail($items[$i]->ID) ?></li>
<?php } ?>

