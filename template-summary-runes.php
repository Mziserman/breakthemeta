<?php
$quintessence = get_field_object('quintessences')['value'];
$seal = get_field_object('seals')['value'];
$glyph = get_field_object('glyphs')['value'];
$mark = get_field_object('marks')['value'];
?>

<!-- Quintessences -->
<?php for ($i = 0; $i < count($quintessence); $i++) { ?>
	<li>
		<?php echo get_the_post_thumbnail($quintessence[$i]['quintessence']->ID, [64, 64]); ?><span><?php echo $quintessence[$i]['quantity']; ?></span>
		<div>
			<h4 class="quint"><?php echo $quintessence[$i]['quintessence']->post_title; ?></h4>
			<p><?php echo $quintessence[$i]['quintessence']->post_content; ?></p>
		</div>
	</li>
<?php } ?>
<!-- Mark -->
<?php for ($i = 0; $i < count($mark); $i++) { ?>
	<li>
		<?php echo get_the_post_thumbnail($mark[$i]['mark']->ID); ?><span><?php echo $mark[$i]['quantity']; ?></span>
		<div>
			<h4 class="mark"><?php echo $mark[$i]['mark']->post_title; ?></h4>
			<p><?php echo $mark[$i]['mark']->post_content; ?></p>
		</div>
	</li>
<?php } ?>
<!-- Seal -->
<?php for ($i = 0; $i < count($seal); $i++) { ?>
	<li>
		<?php echo get_the_post_thumbnail($seal[$i]['seal']->ID); ?><span><?php echo $seal[$i]['quantity']; ?></span>
		<div>
			<h4 class="seal"><?php echo $seal[$i]['seal']->post_title; ?></h4>
			<p><?php echo $seal[$i]['seal']->post_content; ?></p>
		</div>
	</li>
<?php } ?>
<!-- Glyph -->
<?php for ($i = 0; $i < count($glyph); $i++) { ?>
	<li>
		<?php echo get_the_post_thumbnail($glyph[$i]['glyph']->ID); ?><span><?php echo $glyph[$i]['quantity']; ?></span>
		<div>
			<h4 class="glyph"><?php echo $glyph[$i]['glyph']->post_title; ?></h4>
			<p><?php echo $glyph[$i]['glyph']->post_content; ?></p>
		</div>
	</li>
<?php } ?>