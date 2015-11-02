<?php 
	/* Template name: Create build */	
	get_header();

  	require_once (dirname(__DIR__).'/breakthemeta/php/create-build.class.php');

  	global $wpdb;
  	global $cb;
  	$cb = new Create_build($wpdb);
  	if ( !empty($_POST) )
  	{
  		$image_id = get_post_thumbnail_id( $_POST['champ'] );
  		$post_id = $cb->create_post($_POST['title'],$_POST['description'],'build',$_POST['excerpt'],$image_id);
  		if ( !empty($post_id) )
  		{
	  		// champion
  			update_field("champion", $_POST['champ'], $post_id);

  			// begin item
  			$begin_item = get_field(field_5630ea67f0b4b, $post_id);
	  		for ( $i = 1; $i <= 6; $i++ )
		  	{			
		  		if ( !empty($_POST['begin-item-'.$i]) )
		  		{
					$begin_item[] = array("items" => $_POST['begin-item-'.$i]);		
		  		}
		  	}
		  	update_field( field_5630ea67f0b4b, $begin_item, $post_id );

  			// end item
  			$end_item = get_field(field_5630ebc3f0b4c, $post_id);
	  		for ( $i = 1; $i <= 6; $i++ )
		  	{			
		  		if ( !empty($_POST['end-item-'.$i]) )
		  		{
					$end_item[] = array("items" => $_POST['end-item-'.$i]);		
		  		}
		  	}
		  	update_field( field_5630ebc3f0b4c, $end_item, $post_id );


		  	// summoner spell
  			$summoner = get_field(field_5630e250b0a69, $post_id);
	  		for ( $i = 1; $i <= 2; $i++ )
		  	{			
		  		if ( !empty($_POST['summoner-'.$i]) )
		  		{
					$summoner[] = array("spell" => $_POST['summoner-'.$i]);		
		  		}
		  	}
		  	update_field( field_5630e250b0a69, $summoner, $post_id );

  		}

  		// MARKS
  		$get_marks = [];
  		for ( $i =1; $i <= 9; $i ++ )
  		{
  			$get_marks[] = $_POST['red-runes-'.$i];
  		}
  		$marks_sorted = $cb->preset_runes($get_marks);

  		$marks = get_field(field_5631ecf03daf7, $post_id);
  		for ( $i = 0; $i < count($marks_sorted); $i ++ )
  		{
  			if ( !empty($marks_sorted[$i]['rune']) )
		  		{
					$marks[] = array("mark" => $marks_sorted[$i]['rune'], 'quantity' => $marks_sorted[$i]['quantity']);		
		  		}
  		}
  		update_field( field_5631ecf03daf7, $marks, $post_id );

  		// GLYPHS
  		$get_glyphs = [];
  		for ( $i =1; $i <= 9; $i ++ )
  		{
  			$get_glyphs[] = $_POST['blue-runes-'.$i];
  		}
  		$glyphs_sorted = $cb->preset_runes($get_glyphs);

  		$glyphs = get_field(field_5631edb53dafd, $post_id);
  		for ( $i = 0; $i < count($glyphs_sorted); $i ++ )
  		{
  			if ( !empty($glyphs_sorted[$i]['rune']) )
		  		{
					$glyphs[] = array("glyph" => $glyphs_sorted[$i]['rune'], 'quantity' => $glyphs_sorted[$i]['quantity']);		
		  		}
  		}
  		update_field( field_5631edb53dafd, $glyphs, $post_id );

  		// SEALS
  		$get_seals = [];
  		for ( $i =1; $i <= 9; $i ++ )
  		{
  			$get_seals[] = $_POST['yellow-runes-'.$i];
  		}
  		$seals_sorted = $cb->preset_runes($get_seals);

  		$seals = get_field(field_5631ed3d3dafb, $post_id);
  		for ( $i = 0; $i < count($seals_sorted); $i ++ )
  		{
  			if ( !empty($seals_sorted[$i]['rune']) )
		  		{
					$seals[] = array("seal" => $seals_sorted[$i]['rune'], 'quantity' => $seals_sorted[$i]['quantity']);		
		  		}
  		}
  		update_field( field_5631ed3d3dafb, $seals, $post_id );

  		// QUINTE
  		$get_quintes = [];
  		for ( $i =1; $i <= 9; $i ++ )
  		{
  			$get_quintes[] = $_POST['black-runes-'.$i];
  		}
  		$quintes_sorted = $cb->preset_runes($get_quintes);

  		$quintes = get_field(field_5631e6a4768f7, $post_id);
  		for ( $i = 0; $i < count($quintes_sorted); $i ++ )
  		{
  			if ( !empty($quintes_sorted[$i]['rune']) )
		  		{
					$quintes[] = array("quintessence" => $quintes_sorted[$i]['rune'], 'quantity' => $quintes_sorted[$i]['quantity']);		
		  		}
  		}
  		update_field( field_5631e6a4768f7, $quintes, $post_id );
  	}

?>

	<div class="container create-build-container">

		<form method="POST" create-build>
			<div class="build-content">
			
				<div class="aside">
					<div class="validate-button">
						<input type="submit" value="Submit the build">
					</div>
					<ul class="panel-choice-detail">
						<li class="active"><a href="#panel-1">Champion</a></li>
						<li><a href="#panel-2">Items</a></li>
						<li><a href="#panel-3">Spells order</a></li>
						<li><a href="#panel-4">Summoner spell</a></li>
						<li><a href="#panel-5">Masteries</a></li>
						<li><a href="#panel-6">Runes</a></li>
						<li><a href="#panel-7">Gameplay</a></li>
					</ul>
				</div>
				<div class="main create-build"  >
					<a class="back-link" href="<?php echo get_site_url(); ?>/build/" class="pull-right"><i class="icon-arrow-left"></i>Back to builds</a>
					<div class="panel show" id="panel-1" champion>
						<div class="panel-section">
							<h3>Guide title</h3>
							<input type="text" name="title">
						</div>
						<div class="description">
							<h3>Breve description</h3>
							<textarea name="excerpt"></textarea>
						</div>
						
						<div class="champions">
							<h3>Champion</h3>


	    					<img class="item-chosen" src="" champion-chosen>
	    					<span class="item-chosen-name" champion-chosen-name></span>
	    					<input type="hidden" name="champ" champion-input>

		    				<div class="champ-list">
			    				<?php
			                	$args = array('post_type' => 'champion','posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li  class="champ-list-item" champion-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span class="shadow"></span>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span class="champion-name"><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>
	    				</div>
					</div>

					<div class="panel" id="panel-2" item>
						<h3>Starter item</h3>
						<div class="begin-item">
							<ul class="begin-end">
								<li class="item-chosen" begin-item-chosen>
									<img src="">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-1" begin-item-input>
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-2" begin-item-input>
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-3" begin-item-input>
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-4" begin-item-input>
								</li>
								<!-- <li class="item-chosen" begin-item-chosen>
									<img src="">
									<input type="hidden" name="begin-item-5" begin-item-input>
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="">
									<input type="hidden" name="begin-item-6" begin-item-input>
								</li> -->
							</ul>
							<div class="champ-list">
			    				<?php
			                	$args = array('post_type' => 'item','posts_per_page' => -1,'time' => 'begin', 'orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" begin-item-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span class="shadow"></span>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span class="item-name"><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
						<h3>Core item</h3>
						<div class="end-item">
							<ul class="begin-end">
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-1" end-item-input>
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-2" end-item-input>
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-3" end-item-input>
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-4" end-item-input>
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-5" end-item-input>
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-6" end-item-input>
								</li>
							</ul>
							<div class="champ-list">
			    				<?php
			                	$args = array('post_type' => 'item','posts_per_page' => -1,'time' => 'end', 'orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" end-item-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span class="shadow"></span>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span class="item-name"><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
					</div>

					<div class="panel" id="panel-3">
						
					</div>
					<div class="panel" id="panel-4" summoner>
						<div class="summoner-spell">
							<h3>Summoner spell</h3>
							<ul>
								<li class="item-chosen" summoner-chosen>
									<img src="">
									<input type="hidden" name="summoner-1" summoner-input>
								</li>
								<li class="item-chosen" summoner-chosen>
									<img src="">
									<input type="hidden" name="summoner-2" summoner-input>
								</li>
							</ul>
							<div class="champ-list">
			    				<?php
			                	$args = array('post_type' => 'summoner_spell','posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" summoner-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span class="shadow"></span>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
					</div>

					<div class="panel" id="panel-5">
						<h3>Test</h3>
					</div>

					<div class="panel" id="panel-6" runes>
						<h3>Marks</h3>
						<div class="runes-marks">
							<ul class="chosen-runes">
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-1" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-2" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-3" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-4" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-5" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-6" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-7" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-8" red-runes-input>
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="">
									<input type="hidden" name="red-runes-9" red-runes-input>
								</li>
							</ul>
							<div class="runes-list">
			    				<?php
			                	$args = array('post_type' => 'rune','posts_per_page' => -1,'kind' => 'red','orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" red-runes-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
						<h3>Seal</h3>
						<div class="runes-seal">
							<ul class="chosen-runes">
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-1" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-2" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-3" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-4" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-5" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-6" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-7" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-8" yellow-runes-input>
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="">
									<input type="hidden" name="yellow-runes-9" yellow-runes-input>
								</li>
							</ul>
							<div class="runes-list">
			    				<?php
			                	$args = array('post_type' => 'rune','posts_per_page' => -1,'kind' => 'yellow','orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" yellow-runes-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
						<h3>Glyph</h3>
						<div class="runes-glyph">
							<ul class="chosen-runes">
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-1" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-2" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-3" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-4" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-5" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-6" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-7" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-8" blue-runes-input>
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="">
									<input type="hidden" name="blue-runes-9" blue-runes-input>
								</li>
							</ul>
							<div class="runes-list">
			    				<?php
			                	$args = array('post_type' => 'rune','posts_per_page' => -1,'kind' => 'blue','orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" blue-runes-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
						<h3>Quint</h3>
						<div class="runes-quinte">
							<ul class="chosen-runes">
								<li class="item-chosen" black-runes-chosen>
									<img src="">
									<input type="hidden" name="black-runes-1" black-runes-input>
								</li>
								<li class="item-chosen" black-runes-chosen>
									<img src="">
									<input type="hidden" name="black-runes-2" black-runes-input>
								</li>
								<li class="item-chosen" black-runes-chosen>
									<img src="">
									<input type="hidden" name="black-runes-3" black-runes-input>
								</li>
							</ul>
							<div class="runes-list">
			    				<?php
			                	$args = array('post_type' => 'rune','posts_per_page' => -1,'kind' => 'black','orderby' => 'title', 'order' => 'ASC');
			                	$the_query = new WP_Query( $args );
			                	?>
			                	<?php if ($the_query->have_posts()) : ?>
				                    <ul>
				                    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				                        <!-- Gallery Item -->
				                        <li class="champ-list-item" black-runes-select><a href="#">
				                            <?php if ( has_post_thumbnail() ) : ?>
				                            	<span class="shadow"></span>
				                            	<span><?php the_post_thumbnail('icon_liste'); ?></span>
				                            	<span><?php the_title() ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
						<div class="panel-section">
							<h3>Why these runes ?</h3>
							<textarea name="rune_description"></textarea>
						</div>
					</div>
					<div class="panel" id="panel-7" gameplay>
						<div class="panel-section">
							<h3>How to play this build ?</h3>
							<textarea name="description"></textarea>
						</div>
					</div>	
				</div>
			
			</div>
		</form>
	</div>

<?php get_footer(); ?>