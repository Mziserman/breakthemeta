<?php 
	$items = get_field_object('end_items')['value'];
?>
<?php for ($i = 0; $i < count($items); $i++){ ?>
	<li><?php echo get_the_post_thumbnail($items[$i]['items'][0]->ID) ?></li>
<?php } ?>