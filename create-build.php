<?php 
	/* Template name: Create build */	


  	require_once (dirname(__DIR__).'/breakthemeta/php/create-build.class.php');

  	global $wpdb;
  	global $cb;
  	$cb = new Create_build($wpdb);
  	if ( !empty($_POST) )
  	{

  		if ( empty($cb->handleErrors($_POST)) )
  		{
  			$image_id = get_post_thumbnail_id( $_POST['champ'] );

	  		$post_id = $cb->create_post($_POST['title'],$_POST['description'],'build',$_POST['excerpt'],$image_id);

	  		if ( !empty($post_id) )
	  		{
	  			// champion
				update_field("champion", $_POST['champ'], $post_id);

	  			// lane
	  			wp_set_object_terms( $post_id, $_POST['lane'], 'lane');

	  			// role
	  			wp_set_object_terms( $post_id, $_POST['role'], 'role');

	  			// begin item
	  			$begin_item = get_field(field_5630ea67f0b4b, $post_id);
		  		for ( $i = 1; $i <= 4; $i++ )
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


			  	// spell order
		  		$spell_order = get_field(field_563788d6796f6, $post_id);
		  		for ( $i = 1; $i <= 18; $i ++ )
			  	{			
			  		for ( $j = 1; $j <= 5; $j ++)
			  		{
				  		if ( !empty($_POST['order-input-'.$j.'-'.$i]) && $_POST['order-input-'.$j.'-'.$i] == 1 )
				  		{
							$spell_order[] = array("line" => $j );		
				  		}
			  		}
			  	}
			  	update_field( field_563788d6796f6, $spell_order, $post_id );

	  		

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
		  		
		  		$url = get_post_permalink($post_id);
		  		wp_redirect($url);
				exit();
  			}
  		} else {
  			$errors = $cb->handleErrors($_POST);
  			if ( !empty($errors['begin-item']) || !empty($errors['end-item']) )
  			{
  				$errors['location'][] = "items"; 
  			}
  			if ( !empty($errors['spell-order']) )
  			{
  				$errors['location'][] = "spell order"; 
  			}
  			if ( !empty($errors['summoner']) )
  			{
  				$errors['location'][] = "summoner"; 
  			}
  			if ( !empty($errors['marks']) || !empty($errors['seals']) || !empty($errors['glyphs']) || !empty($errors['quintes']) )
  			{
  				$errors['location'][] = "runes"; 
  			}

  			if ( isset($errors['location']) && !empty($errors['location']) )
  			{
  				$errors['where'] = "You have errors in";
  				$i = 1;
  				foreach ($errors['location'] as $location) {
  					if ( $i == ( count($errors['location']) - 1 ) )
  						$errors['where'] .= " ".$location. " and";
					else if ( $i == ( count($errors['location']) ) )
  						$errors['where'] .= " ".$location. ".";
  					else
  						$errors['where'] .= " ".$location. ",";

  					$i ++;
  				}
  			}
  		}
  	}

	get_header();
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
						<!-- <li><a href="#panel-5">Masteries</a></li> -->
						<li><a href="#panel-6">Runes</a></li>
						<li><a href="#panel-7">Gameplay</a></li>
					</ul>
				</div>
				<div class="main create-build"  >
					<div class="panel show " id="panel-1" champion>
						<div class="errors">
							<?php if ( isset($errors['where']) && !empty($errors['where']) ) : ?>
								<?php echo $errors['where'] ?>
							<?php endif ?>
						</div>
						<div class="panel-section">
							<?php if ( isset($errors['title']) && !empty($errors['title']) ) : ?>
								<?php echo $errors['title'] ?>
							<?php endif ?>
							<h3>Guide title</h3>
							<input type="text" name="title" value="<?php if ( isset($_POST['title']) ) echo $_POST['title']?>">
						</div>
						<div class="description">
							<?php if ( isset($errors['excerpt']) && !empty($errors['excerpt']) ) : ?>
								<?php echo $errors['excerpt'] ?>
							<?php endif ?>
							<h3>Short description</h3>
							<textarea name="excerpt" ><?php if ( isset($_POST['excerpt']) ) echo $_POST['excerpt']?></textarea>
						</div>

			    		
			    		<div class="lane">
							<h3>For which lane ?</h3>
							<span class="custom-dropdown">
								<select name="lane">
									<option value="all" >All</option>
									<option value="top" >Top</option>
									<option value="mid" >Mid</option>
									<option value="jungle" >Jungle</option>
									<option value="bottom" >Bottom</option>
								</select>
							</span>
			            </div>
			            
			            <div class="roles">
			              	<h3>Which role ?</h3>
			              	<span class="custom-dropdown">
			            		<select name="role">
									<option value="carry_ad" >Carry AD</option>
									<option value="carry_ap" >Carry AP</option>
									<option value="tank" >Tank</option>
									<option value="support" >Support</option>
			            		</select>
							</span>
			            </div>
						
						<div class="champions">
							<?php if ( isset($errors['champ']) && !empty($errors['champ']) ) : ?>
								<?php echo $errors['champ'] ?>
							<?php endif ?>
							<h3>Champion</h3>

	    					<img class="item-chosen" src="<?php if ( isset($_POST['champ']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['champ']));?>" champion-chosen>
	    					<span class="item-chosen-name" champion-chosen-name></span>
	    					<input type="hidden" name="champ" champion-input value="<?php if ( isset($_POST['champ']) ) echo $_POST['champ']?>">
							<div class="search-champion">
    							<form action=""><input champion-search type="search" class="search-field" name="search-champ" id="search-champ" placeholder="Search champion"><button type="submit"><i class="fa fa-search"></i></button></form>
    						</div>
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
						<?php if ( isset($errors['begin-item']) && !empty($errors['begin-item']) ) : ?>
								<?php echo $errors['begin-item'] ?>
							<?php endif ?>
						<h3>Starter item</h3>
						<div class="begin-item">
							<ul class="begin-end">
								<li class="item-chosen" begin-item-chosen>
									<img src="<?php if ( isset($_POST['begin-item-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['begin-item-1']));?>">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-1" begin-item-input value="<?php if ( isset($_POST['begin-item-1']) ) echo $_POST['begin-item-1']?>">
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="<?php if ( isset($_POST['begin-item-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['begin-item-2']));?>">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-2" begin-item-input value="<?php if ( isset($_POST['begin-item-2']) ) echo $_POST['begin-item-2']?>" >
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="<?php if ( isset($_POST['begin-item-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['begin-item-3']));?>">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-3" begin-item-input value="<?php if ( isset($_POST['begin-item-3']) ) echo $_POST['begin-item-3']?>" >
								</li>
								<li class="item-chosen" begin-item-chosen>
									<img src="<?php if ( isset($_POST['begin-item-4']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['begin-item-4']));?>">
									<span class="item-chosen-name" begin-item-name></span>
									<input type="hidden" name="begin-item-4" begin-item-input value="<?php if ( isset($_POST['begin-item-4']) ) echo $_POST['begin-item-4']?>" >
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
						<?php if ( isset($errors['end-item']) && !empty($errors['end-item']) ) : ?>
							<?php echo $errors['end-item'] ?>
						<?php endif ?>
						<h3>Core item</h3>
						<div class="end-item">
							<ul class="begin-end">
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-1']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-1" end-item-input value="<?php if ( isset($_POST['end-item-1']) ) echo $_POST['end-item-1']?>">
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-2']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-2" end-item-input value="<?php if ( isset($_POST['end-item-2']) ) echo $_POST['end-item-2']?>">
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-3']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-3" end-item-input value="<?php if ( isset($_POST['end-item-3']) ) echo $_POST['end-item-3']?>">
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-4']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-4']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-4" end-item-input value="<?php if ( isset($_POST['end-item-4']) ) echo $_POST['end-item-4']?>">
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-5']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-5']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-5" end-item-input value="<?php if ( isset($_POST['end-item-5']) ) echo $_POST['end-item-5']?>">
								</li>
								<li class="item-chosen" end-item-chosen>
									<img src="<?php if ( isset($_POST['end-item-6']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['end-item-6']));?>">
									<span class="item-chosen-name" end-item-name></span>
									<input type="hidden" name="end-item-6" end-item-input value="<?php if ( isset($_POST['end-item-6']) ) echo $_POST['end-item-6']?>">
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

				                            	<span class="champion-name"><?php if (preg_match('/^Enchantment/', the_title())) : str_ireplace('Enchantment', '', the_title()); endif; ?></span>
				                            	<input type="hidden" value="<?php echo the_ID(); ?>"> 
				                        	<?php endif ?>
				                        </a></li>
				                    <?php endwhile; ?>

				                    </ul>
			                	<?php endif; ?>
		    				</div>

						</div>
					</div>

					<div class="panel skill-order" id="panel-3" skill-order>
						<?php if ( isset($errors['spell-order']) && !empty($errors['spell-order']) ) : ?>
							<?php echo $errors['spell-order'] ?>
						<?php endif ?>
						<h3>Skill Order</h3>
							<div class="panel-section">
								<div class="so-header">
									<p class="so-level">Player level</p>
									<p class="so-skill-level">1</p>
									<p class="so-skill-level">2</p>
									<p class="so-skill-level">3</p>
									<p class="so-skill-level">4</p>
									<p class="so-skill-level">5</p>
									<p class="so-skill-level">6</p>
									<p class="so-skill-level">7</p>
									<p class="so-skill-level">8</p>
									<p class="so-skill-level">9</p>
									<p class="so-skill-level">10</p>
									<p class="so-skill-level">11</p>
									<p class="so-skill-level">12</p>
									<p class="so-skill-level">13</p>
									<p class="so-skill-level">14</p>
									<p class="so-skill-level">15</p>
									<p class="so-skill-level">16</p>
									<p class="so-skill-level">17</p>
									<p class="so-skill-level">18</p>
								</div>
								<div class="so-table">
									<div class="table-line">
										<span class="table-line-control">Q</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-q src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('q_spell', $_POST['champ'])['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="1" class="table-line-skill first <?php if ( isset($_POST['order-input-1-1']) && $_POST['order-input-1-1'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-1']) ) echo $_POST['order-input-1-1']; else echo "0" ?>" type="hidden" name="order-input-1-1"></div></div>
										<div order-select order-level="2" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-2']) && $_POST['order-input-1-2'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-2']) ) echo $_POST['order-input-1-2']; else echo "0" ?>" type="hidden" name="order-input-1-2"></div></div>
										<div order-select order-level="3" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-3']) && $_POST['order-input-1-3'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-3']) ) echo $_POST['order-input-1-3']; else echo "0" ?>" type="hidden" name="order-input-1-3"></div></div>
										<div order-select order-level="4" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-4']) && $_POST['order-input-1-4'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-4']) ) echo $_POST['order-input-1-4']; else echo "0" ?>" type="hidden" name="order-input-1-4"></div></div>
										<div order-select order-level="5" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-5']) && $_POST['order-input-1-5'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-5']) ) echo $_POST['order-input-1-5']; else echo "0" ?>" type="hidden" name="order-input-1-5"></div></div>
										<div order-select order-level="6" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-6']) && $_POST['order-input-1-6'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-6']) ) echo $_POST['order-input-1-6']; else echo "0" ?>" type="hidden" name="order-input-1-6"></div></div>
										<div order-select order-level="7" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-7']) && $_POST['order-input-1-7'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-7']) ) echo $_POST['order-input-1-7']; else echo "0" ?>" type="hidden" name="order-input-1-7"></div></div>
										<div order-select order-level="8" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-8']) && $_POST['order-input-1-8'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-8']) ) echo $_POST['order-input-1-8']; else echo "0" ?>" type="hidden" name="order-input-1-8"></div></div>
										<div order-select order-level="9" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-9']) && $_POST['order-input-1-9'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-9']) ) echo $_POST['order-input-1-9']; else echo "0" ?>" type="hidden" name="order-input-1-9"></div></div>
										<div order-select order-level="10" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-10']) && $_POST['order-input-1-10'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-10']) ) echo $_POST['order-input-1-10']; else echo "0" ?>" type="hidden" name="order-input-1-10"></div></div>
										<div order-select order-level="11" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-11']) && $_POST['order-input-1-11'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-11']) ) echo $_POST['order-input-1-11']; else echo "0" ?>" type="hidden" name="order-input-1-11"></div></div>
										<div order-select order-level="12" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-12']) && $_POST['order-input-1-12'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-12']) ) echo $_POST['order-input-1-12']; else echo "0" ?>" type="hidden" name="order-input-1-12"></div></div>
										<div order-select order-level="13" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-13']) && $_POST['order-input-1-13'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-13']) ) echo $_POST['order-input-1-13']; else echo "0" ?>" type="hidden" name="order-input-1-13"></div></div>
										<div order-select order-level="14" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-14']) && $_POST['order-input-1-14'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-14']) ) echo $_POST['order-input-1-14']; else echo "0" ?>" type="hidden" name="order-input-1-14"></div></div>
										<div order-select order-level="15" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-15']) && $_POST['order-input-1-15'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-15']) ) echo $_POST['order-input-1-15']; else echo "0" ?>" type="hidden" name="order-input-1-15"></div></div>
										<div order-select order-level="16" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-16']) && $_POST['order-input-1-16'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-16']) ) echo $_POST['order-input-1-16']; else echo "0" ?>" type="hidden" name="order-input-1-16"></div></div>
										<div order-select order-level="17" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-17']) && $_POST['order-input-1-17'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-17']) ) echo $_POST['order-input-1-17']; else echo "0" ?>" type="hidden" name="order-input-1-17"></div></div>
										<div order-select order-level="18" order-line="1" class="table-line-skill <?php if ( isset($_POST['order-input-1-18']) && $_POST['order-input-1-18'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-1-18']) ) echo $_POST['order-input-1-18']; else echo "0" ?>" type="hidden" name="order-input-1-18"></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">W</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-w src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('w_spell', $_POST['champ'])['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-1']) && $_POST['order-input-2-1'] == 1 ) echo "active";?> first"><div><input value="<?php if ( isset($_POST['order-input-2-1']) ) echo $_POST['order-input-2-1']; else echo "0" ?>" type="hidden" name="order-input-2-1"></div></div>
										<div order-select order-level="2" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-2']) && $_POST['order-input-2-2'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-2']) ) echo $_POST['order-input-2-2']; else echo "0" ?>" type="hidden" name="order-input-2-2"></div></div>
										<div order-select order-level="3" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-3']) && $_POST['order-input-2-3'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-3']) ) echo $_POST['order-input-2-3']; else echo "0" ?>" type="hidden" name="order-input-2-3"></div></div>
										<div order-select order-level="4" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-4']) && $_POST['order-input-2-4'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-4']) ) echo $_POST['order-input-2-4']; else echo "0" ?>" type="hidden" name="order-input-2-4"></div></div>
										<div order-select order-level="5" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-5']) && $_POST['order-input-2-5'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-5']) ) echo $_POST['order-input-2-5']; else echo "0" ?>" type="hidden" name="order-input-2-5"></div></div>
										<div order-select order-level="6" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-6']) && $_POST['order-input-2-6'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-6']) ) echo $_POST['order-input-2-6']; else echo "0" ?>" type="hidden" name="order-input-2-6"></div></div>
										<div order-select order-level="7" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-7']) && $_POST['order-input-2-7'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-7']) ) echo $_POST['order-input-2-7']; else echo "0" ?>" type="hidden" name="order-input-2-7"></div></div>
										<div order-select order-level="8" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-8']) && $_POST['order-input-2-8'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-8']) ) echo $_POST['order-input-2-8']; else echo "0" ?>" type="hidden" name="order-input-2-8"></div></div>
										<div order-select order-level="9" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-9']) && $_POST['order-input-2-9'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-9']) ) echo $_POST['order-input-2-9']; else echo "0" ?>" type="hidden" name="order-input-2-9"></div></div>
										<div order-select order-level="10" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-10']) && $_POST['order-input-2-10'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-10']) ) echo $_POST['order-input-2-10']; else echo "0" ?>" type="hidden" name="order-input-2-10"></div></div>
										<div order-select order-level="11" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-11']) && $_POST['order-input-2-11'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-11']) ) echo $_POST['order-input-2-11']; else echo "0" ?>" type="hidden" name="order-input-2-11"></div></div>
										<div order-select order-level="12" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-12']) && $_POST['order-input-2-12'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-12']) ) echo $_POST['order-input-2-12']; else echo "0" ?>" type="hidden" name="order-input-2-12"></div></div>
										<div order-select order-level="13" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-13']) && $_POST['order-input-2-13'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-13']) ) echo $_POST['order-input-2-13']; else echo "0" ?>" type="hidden" name="order-input-2-13"></div></div>
										<div order-select order-level="14" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-14']) && $_POST['order-input-2-14'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-14']) ) echo $_POST['order-input-2-14']; else echo "0" ?>" type="hidden" name="order-input-2-14"></div></div>
										<div order-select order-level="15" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-15']) && $_POST['order-input-2-15'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-15']) ) echo $_POST['order-input-2-15']; else echo "0" ?>" type="hidden" name="order-input-2-15"></div></div>
										<div order-select order-level="16" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-16']) && $_POST['order-input-2-16'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-16']) ) echo $_POST['order-input-2-16']; else echo "0" ?>" type="hidden" name="order-input-2-16"></div></div>
										<div order-select order-level="17" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-17']) && $_POST['order-input-2-17'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-17']) ) echo $_POST['order-input-2-17']; else echo "0" ?>" type="hidden" name="order-input-2-17"></div></div>
										<div order-select order-level="18" order-line="2" class="table-line-skill <?php if ( isset($_POST['order-input-2-18']) && $_POST['order-input-2-18'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-2-18']) ) echo $_POST['order-input-2-18']; else echo "0" ?>" type="hidden" name="order-input-2-18"></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">E</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-e src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('e_spell', $_POST['champ'])['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-1']) && $_POST['order-input-3-1'] == 1 ) echo "active";?> first"><div><input value="<?php if ( isset($_POST['order-input-3-1']) ) echo $_POST['order-input-3-1']; else echo "0" ?>" type="hidden" name="order-input-3-1"></div></div>
										<div order-select order-level="2" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-2']) && $_POST['order-input-3-2'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-2']) ) echo $_POST['order-input-3-2']; else echo "0" ?>" type="hidden" name="order-input-3-2"></div></div>
										<div order-select order-level="3" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-3']) && $_POST['order-input-3-3'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-3']) ) echo $_POST['order-input-3-3']; else echo "0" ?>" type="hidden" name="order-input-3-3"></div></div>
										<div order-select order-level="4" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-4']) && $_POST['order-input-3-4'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-4']) ) echo $_POST['order-input-3-4']; else echo "0" ?>" type="hidden" name="order-input-3-4"></div></div>
										<div order-select order-level="5" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-5']) && $_POST['order-input-3-5'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-5']) ) echo $_POST['order-input-3-5']; else echo "0" ?>" type="hidden" name="order-input-3-5"></div></div>
										<div order-select order-level="6" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-6']) && $_POST['order-input-3-6'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-6']) ) echo $_POST['order-input-3-6']; else echo "0" ?>" type="hidden" name="order-input-3-6"></div></div>
										<div order-select order-level="7" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-7']) && $_POST['order-input-3-7'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-7']) ) echo $_POST['order-input-3-7']; else echo "0" ?>" type="hidden" name="order-input-3-7"></div></div>
										<div order-select order-level="8" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-8']) && $_POST['order-input-3-8'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-8']) ) echo $_POST['order-input-3-8']; else echo "0" ?>" type="hidden" name="order-input-3-8"></div></div>
										<div order-select order-level="9" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-9']) && $_POST['order-input-3-9'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-9']) ) echo $_POST['order-input-3-9']; else echo "0" ?>" type="hidden" name="order-input-3-9"></div></div>
										<div order-select order-level="10" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-10']) && $_POST['order-input-3-10'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-10']) ) echo $_POST['order-input-3-10']; else echo "0" ?>" type="hidden" name="order-input-3-1O"></div></div>
										<div order-select order-level="11" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-11']) && $_POST['order-input-3-11'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-11']) ) echo $_POST['order-input-3-11']; else echo "0" ?>" type="hidden" name="order-input-3-11"></div></div>
										<div order-select order-level="12" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-12']) && $_POST['order-input-3-12'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-12']) ) echo $_POST['order-input-3-12']; else echo "0" ?>" type="hidden" name="order-input-3-12"></div></div>
										<div order-select order-level="13" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-13']) && $_POST['order-input-3-13'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-13']) ) echo $_POST['order-input-3-13']; else echo "0" ?>" type="hidden" name="order-input-3-13"></div></div>
										<div order-select order-level="14" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-14']) && $_POST['order-input-3-14'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-14']) ) echo $_POST['order-input-3-14']; else echo "0" ?>" type="hidden" name="order-input-3-14"></div></div>
										<div order-select order-level="15" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-15']) && $_POST['order-input-3-15'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-15']) ) echo $_POST['order-input-3-15']; else echo "0" ?>" type="hidden" name="order-input-3-15"></div></div>
										<div order-select order-level="16" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-16']) && $_POST['order-input-3-16'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-16']) ) echo $_POST['order-input-3-16']; else echo "0" ?>" type="hidden" name="order-input-3-16"></div></div>
										<div order-select order-level="17" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-17']) && $_POST['order-input-3-17'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-17']) ) echo $_POST['order-input-3-17']; else echo "0" ?>" type="hidden" name="order-input-3-17"></div></div>
										<div order-select order-level="18" order-line="3" class="table-line-skill <?php if ( isset($_POST['order-input-3-18']) && $_POST['order-input-3-18'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-3-18']) ) echo $_POST['order-input-3-18']; else echo "0" ?>" type="hidden" name="order-input-3-18"></div></div>
									</div>
									<div class="table-line">
										<p class="table-line-control">R</p>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-r src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('r_spell', $_POST['champ'])['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-1']) && $_POST['order-input-4-1'] == 1 ) echo "active";?> first"><div><input value="<?php if ( isset($_POST['order-input-4-1']) ) echo $_POST['order-input-4-1']; else echo "0" ?>" type="hidden" name="order-input-4-1"></div></div>
										<div order-select order-level="2" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-2']) && $_POST['order-input-4-2'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-2']) ) echo $_POST['order-input-4-2']; else echo "0" ?>" type="hidden" name="order-input-4-2"></div></div>
										<div order-select order-level="3" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-3']) && $_POST['order-input-4-3'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-3']) ) echo $_POST['order-input-4-3']; else echo "0" ?>" type="hidden" name="order-input-4-3"></div></div>
										<div order-select order-level="4" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-4']) && $_POST['order-input-4-4'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-4']) ) echo $_POST['order-input-4-4']; else echo "0" ?>" type="hidden" name="order-input-4-4"></div></div>
										<div order-select order-level="5" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-5']) && $_POST['order-input-4-5'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-5']) ) echo $_POST['order-input-4-5']; else echo "0" ?>" type="hidden" name="order-input-4-5"></div></div>
										<div order-select order-level="6" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-6']) && $_POST['order-input-4-6'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-6']) ) echo $_POST['order-input-4-6']; else echo "0" ?>" type="hidden" name="order-input-4-6"></div></div>
										<div order-select order-level="7" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-7']) && $_POST['order-input-4-7'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-7']) ) echo $_POST['order-input-4-7']; else echo "0" ?>" type="hidden" name="order-input-4-7"></div></div>
										<div order-select order-level="8" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-8']) && $_POST['order-input-4-8'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-8']) ) echo $_POST['order-input-4-8']; else echo "0" ?>" type="hidden" name="order-input-4-8"></div></div>
										<div order-select order-level="9" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-9']) && $_POST['order-input-4-9'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-9']) ) echo $_POST['order-input-4-9']; else echo "0" ?>" type="hidden" name="order-input-4-9"></div></div>
										<div order-select order-level="10" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-10']) && $_POST['order-input-4-10'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-10']) ) echo $_POST['order-input-4-10']; else echo "0" ?>" type="hidden" name="order-input-4-10"></div></div>
										<div order-select order-level="11" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-11']) && $_POST['order-input-4-11'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-11']) ) echo $_POST['order-input-4-11']; else echo "0" ?>" type="hidden" name="order-input-4-11"></div></div>
										<div order-select order-level="12" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-12']) && $_POST['order-input-4-12'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-12']) ) echo $_POST['order-input-4-12']; else echo "0" ?>" type="hidden" name="order-input-4-12"></div></div>
										<div order-select order-level="13" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-13']) && $_POST['order-input-4-13'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-13']) ) echo $_POST['order-input-4-13']; else echo "0" ?>" type="hidden" name="order-input-4-13"></div></div>
										<div order-select order-level="14" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-14']) && $_POST['order-input-4-14'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-14']) ) echo $_POST['order-input-4-14']; else echo "0" ?>" type="hidden" name="order-input-4-14"></div></div>
										<div order-select order-level="15" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-15']) && $_POST['order-input-4-15'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-15']) ) echo $_POST['order-input-4-15']; else echo "0" ?>" type="hidden" name="order-input-4-15"></div></div>
										<div order-select order-level="16" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-16']) && $_POST['order-input-4-16'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-16']) ) echo $_POST['order-input-4-16']; else echo "0" ?>" type="hidden" name="order-input-4-16"></div></div>
										<div order-select order-level="17" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-17']) && $_POST['order-input-4-17'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-17']) ) echo $_POST['order-input-4-17']; else echo "0" ?>" type="hidden" name="order-input-4-17"></div></div>
										<div order-select order-level="18" order-line="4" class="table-line-skill <?php if ( isset($_POST['order-input-4-18']) && $_POST['order-input-4-18'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-4-18']) ) echo $_POST['order-input-4-18']; else echo "0" ?>" type="hidden" name="order-input-4-18"></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">∞</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-passive src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('passive', $_POST['champ'])['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-1']) && $_POST['order-input-5-1'] == 1 ) echo "active";?> first"><div><input value="<?php if ( isset($_POST['order-input-5-1']) ) echo $_POST['order-input-5-1']; else echo "0" ?>" type="hidden" name="order-input-5-1"></div></div>
										<div order-select order-level="2" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-2']) && $_POST['order-input-5-2'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-2']) ) echo $_POST['order-input-5-2']; else echo "0" ?>" type="hidden" name="order-input-5-2"></div></div>
										<div order-select order-level="3" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-3']) && $_POST['order-input-5-3'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-3']) ) echo $_POST['order-input-5-3']; else echo "0" ?>" type="hidden" name="order-input-5-3"></div></div>
										<div order-select order-level="4" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-4']) && $_POST['order-input-5-4'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-4']) ) echo $_POST['order-input-5-4']; else echo "0" ?>" type="hidden" name="order-input-5-4"></div></div>
										<div order-select order-level="5" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-5']) && $_POST['order-input-5-5'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-5']) ) echo $_POST['order-input-5-5']; else echo "0" ?>" type="hidden" name="order-input-5-5"></div></div>
										<div order-select order-level="6" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-6']) && $_POST['order-input-5-6'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-6']) ) echo $_POST['order-input-5-6']; else echo "0" ?>" type="hidden" name="order-input-5-6"></div></div>
										<div order-select order-level="7" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-7']) && $_POST['order-input-5-7'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-7']) ) echo $_POST['order-input-5-7']; else echo "0" ?>" type="hidden" name="order-input-5-7"></div></div>
										<div order-select order-level="8" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-8']) && $_POST['order-input-5-8'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-8']) ) echo $_POST['order-input-5-8']; else echo "0" ?>" type="hidden" name="order-input-5-8"></div></div>
										<div order-select order-level="9" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-9']) && $_POST['order-input-5-9'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-9']) ) echo $_POST['order-input-5-9']; else echo "0" ?>" type="hidden" name="order-input-5-9"></div></div>
										<div order-select order-level="10" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-10']) && $_POST['order-input-5-10'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-10']) ) echo $_POST['order-input-5-10']; else echo "0" ?>" type="hidden" name="order-input-5-10"></div></div>
										<div order-select order-level="11" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-11']) && $_POST['order-input-5-11'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-11']) ) echo $_POST['order-input-5-11']; else echo "0" ?>" type="hidden" name="order-input-5-11"></div></div>
										<div order-select order-level="12" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-12']) && $_POST['order-input-5-12'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-12']) ) echo $_POST['order-input-5-12']; else echo "0" ?>" type="hidden" name="order-input-5-12"></div></div>
										<div order-select order-level="13" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-13']) && $_POST['order-input-5-13'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-13']) ) echo $_POST['order-input-5-13']; else echo "0" ?>" type="hidden" name="order-input-5-13"></div></div>
										<div order-select order-level="14" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-14']) && $_POST['order-input-5-14'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-14']) ) echo $_POST['order-input-5-14']; else echo "0" ?>" type="hidden" name="order-input-5-14"></div></div>
										<div order-select order-level="15" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-15']) && $_POST['order-input-5-15'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-15']) ) echo $_POST['order-input-5-15']; else echo "0" ?>" type="hidden" name="order-input-5-15"></div></div>
										<div order-select order-level="16" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-16']) && $_POST['order-input-5-16'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-16']) ) echo $_POST['order-input-5-16']; else echo "0" ?>" type="hidden" name="order-input-5-16"></div></div>
										<div order-select order-level="17" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-17']) && $_POST['order-input-5-17'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-17']) ) echo $_POST['order-input-5-17']; else echo "0" ?>" type="hidden" name="order-input-5-17"></div></div>
										<div order-select order-level="18" order-line="5" class="table-line-skill <?php if ( isset($_POST['order-input-5-18']) && $_POST['order-input-5-18'] == 1 ) echo "active";?>"><div><input value="<?php if ( isset($_POST['order-input-5-18']) ) echo $_POST['order-input-5-18']; else echo "0" ?>" type="hidden" name="order-input-5-18"></div></div>
									</div>
								</div>
							</div>
					</div>
					<div class="panel" id="panel-4" summoner>
						<div class="summoner-spell">
							<?php if ( isset($errors['summoner']) && !empty($errors['summoner']) ) : ?>
								<?php echo $errors['summoner'] ?>
							<?php endif ?>
							<h3>Summoner spell</h3>
							<ul>
								<li class="item-chosen" summoner-chosen>
									<img src="<?php if ( isset($_POST['summoner-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['summoner-1']));?>">
									<input type="hidden" name="summoner-1" summoner-input value="<?php if ( isset($_POST['summoner-1']) ) echo $_POST['summoner-1']?>">
								</li>
								<li class="item-chosen" summoner-chosen>
									<img src="<?php if ( isset($_POST['summoner-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['summoner-2']));?>">
									<input type="hidden" name="summoner-2" summoner-input value="<?php if ( isset($_POST['summoner-2']) ) echo $_POST['summoner-2']?>">
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
						<h3>Not avaible for now</h3>
					</div>

					<div class="panel" id="panel-6" runes>
						<?php if ( isset($errors['marks']) && !empty($errors['marks']) ) : ?>
							<?php echo $errors['marks'] ?>
						<?php endif ?>
						<h3>Marks</h3>
						<div class="runes-marks">
							<ul class="chosen-runes">
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-1']));?>">
									<input type="hidden" name="red-runes-1" red-runes-input value="<?php if ( isset($_POST['red-runes']) ) echo $_POST['red-runes']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-2']));?>">
									<input type="hidden" name="red-runes-2" red-runes-input value="<?php if ( isset($_POST['red-runes-2']) ) echo $_POST['red-runes-2']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-3']));?>">
									<input type="hidden" name="red-runes-3" red-runes-input value="<?php if ( isset($_POST['red-runes-3']) ) echo $_POST['red-runes-3']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-4']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-4']));?>">
									<input type="hidden" name="red-runes-4" red-runes-input value="<?php if ( isset($_POST['red-runes-4']) ) echo $_POST['red-runes-4']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-5']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-5']));?>">
									<input type="hidden" name="red-runes-5" red-runes-input value="<?php if ( isset($_POST['red-runes-5']) ) echo $_POST['red-runes-5']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-6']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-6']));?>">
									<input type="hidden" name="red-runes-6" red-runes-input value="<?php if ( isset($_POST['red-runes-6']) ) echo $_POST['red-runes-6']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-7']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-7']));?>">
									<input type="hidden" name="red-runes-7" red-runes-input value="<?php if ( isset($_POST['red-runes-7']) ) echo $_POST['red-runes-7']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-8']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-8']));?>">
									<input type="hidden" name="red-runes-8" red-runes-input value="<?php if ( isset($_POST['red-runes-8']) ) echo $_POST['red-runes-8']?>">
								</li>
								<li class="item-chosen" red-runes-chosen>
									<img src="<?php if ( isset($_POST['red-runes-9']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['red-runes-9']));?>">
									<input type="hidden" name="red-runes-9" red-runes-input value="<?php if ( isset($_POST['red-runes-9']) ) echo $_POST['red-runes-9']?>">
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
						<?php if ( isset($errors['seals']) && !empty($errors['seals']) ) : ?>
							<?php echo $errors['seals'] ?>
						<?php endif ?>
						<h3>Seal</h3>
						<div class="runes-seal">
							<ul class="chosen-runes">
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-1']));?>">
									<input type="hidden" name="yellow-runes-1" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-1']) ) echo $_POST['yellow-runes-1']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-2']));?>">
									<input type="hidden" name="yellow-runes-2" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-2']) ) echo $_POST['yellow-runes-2']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-3']));?>">
									<input type="hidden" name="yellow-runes-3" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-3']) ) echo $_POST['yellow-runes-3']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-4']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-4']));?>">
									<input type="hidden" name="yellow-runes-4" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-4']) ) echo $_POST['yellow-runes-4']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-5']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-5']));?>">
									<input type="hidden" name="yellow-runes-5" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-5']) ) echo $_POST['yellow-runes-5']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-6']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-6']));?>">
									<input type="hidden" name="yellow-runes-6" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-6']) ) echo $_POST['yellow-runes-6']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-7']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-7']));?>">
									<input type="hidden" name="yellow-runes-7" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-7']) ) echo $_POST['yellow-runes-7']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-8']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-8']));?>">
									<input type="hidden" name="yellow-runes-8" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-8']) ) echo $_POST['yellow-runes-8']?>">
								</li>
								<li class="item-chosen" yellow-runes-chosen>
									<img src="<?php if ( isset($_POST['yellow-runes-9']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['yellow-runes-9']));?>">
									<input type="hidden" name="yellow-runes-9" yellow-runes-input value="<?php if ( isset($_POST['yellow-runes-9']) ) echo $_POST['yellow-runes-9']?>">
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
						<?php if ( isset($errors['glyphs']) && !empty($errors['glyphs']) ) : ?>
							<?php echo $errors['glyphs'] ?>
						<?php endif ?>
						<h3>Glyph</h3>
						<div class="runes-glyph">
							<ul class="chosen-runes">
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-1']));?>">
									<input type="hidden" name="blue-runes-1" blue-runes-input value="<?php if ( isset($_POST['blue-runes-1']) ) echo $_POST['blue-runes-1']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-2']));?>">
									<input type="hidden" name="blue-runes-2" blue-runes-input value="<?php if ( isset($_POST['blue-runes-2']) ) echo $_POST['blue-runes-2']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-3']));?>">
									<input type="hidden" name="blue-runes-3" blue-runes-input value="<?php if ( isset($_POST['blue-runes-3']) ) echo $_POST['blue-runes-3']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-4']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-4']));?>">
									<input type="hidden" name="blue-runes-4" blue-runes-input value="<?php if ( isset($_POST['blue-runes-4']) ) echo $_POST['blue-runes-4']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-5']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-5']));?>">
									<input type="hidden" name="blue-runes-5" blue-runes-input value="<?php if ( isset($_POST['blue-runes-5']) ) echo $_POST['blue-runes-5']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-6']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-6']));?>">
									<input type="hidden" name="blue-runes-6" blue-runes-input value="<?php if ( isset($_POST['blue-runes-6']) ) echo $_POST['blue-runes-6']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-7']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-7']));?>">
									<input type="hidden" name="blue-runes-7" blue-runes-input value="<?php if ( isset($_POST['blue-runes-7']) ) echo $_POST['blue-runes-7']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-8']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-8']));?>">
									<input type="hidden" name="blue-runes-8" blue-runes-input value="<?php if ( isset($_POST['blue-runes-8']) ) echo $_POST['blue-runes-8']?>">
								</li>
								<li class="item-chosen" blue-runes-chosen>
									<img src="<?php if ( isset($_POST['blue-runes-9']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['blue-runes-9']));?>">
									<input type="hidden" name="blue-runes-9" blue-runes-input value="<?php if ( isset($_POST['blue-runes-9']) ) echo $_POST['blue-runes-9']?>">
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
						<?php if ( isset($errors['quintes']) && !empty($errors['quintes']) ) : ?>
							<?php echo $errors['quintes'] ?>
						<?php endif ?>
						<h3>Quint</h3>
						<div class="runes-quinte">
							<ul class="chosen-runes">
								<li class="item-chosen" black-runes-chosen>
									<img src="<?php if ( isset($_POST['black-runes-1']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['black-runes-1']));?>">
									<input type="hidden" name="black-runes-1" black-runes-input value="<?php if ( isset($_POST['black-runes-1']) ) echo $_POST['black-runes-1']?>">
								</li>
								<li class="item-chosen" black-runes-chosen>
									<img src="<?php if ( isset($_POST['black-runes-2']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['black-runes-2']));?>">
									<input type="hidden" name="black-runes-2" black-runes-input value="<?php if ( isset($_POST['black-runes-2']) ) echo $_POST['black-runes-2']?>">
								</li>
								<li class="item-chosen" black-runes-chosen>
									<img src="<?php if ( isset($_POST['black-runes-3']) ) echo wp_get_attachment_url( get_post_thumbnail_id($_POST['black-runes-3']));?>">
									<input type="hidden" name="black-runes-3" black-runes-input value="<?php if ( isset($_POST['black-runes-3']) ) echo $_POST['black-runes-3']?>">
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
							<textarea name="description"><?php if ( isset($_POST['description']) ) echo $_POST['description']?></textarea>
						</div>
					</div>	
				</div>
			
			</div>
		</form>
	</div>

<?php get_footer(); ?>