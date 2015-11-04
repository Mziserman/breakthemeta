<?php 
	$summoners = get_field_object('summoner')['value'];
?>

<?php for ($i = 0; $i < count($summoners); $i++) {?>
	<li><a href=""><?php echo get_the_post_thumbnail($summoners[$i]['spell']->ID) ?><span class="champ-name"><?php echo $summoners[$i]['spell']->post_title ?></span></a></li>
<?php } ?>