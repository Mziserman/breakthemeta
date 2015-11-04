<?php 
	$summoners = get_field_object('summoner')['value'];
?>

<?php for ($i = 0; $i < count($summoners); $i++) {?>
	<li><?php echo get_the_post_thumbnail($summoners[$i]['spell']->ID) ?></li>
<?php } ?>