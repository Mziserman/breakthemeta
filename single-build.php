<?php 
	session_start();
	$the_ID = get_the_ID();
    $score = get_field_object('likes')['value'];
	
	if (!empty($_POST['plus'])) {
		
		if (!$_SESSION['voted']) {
			$_SESSION['voted'] = array();
		}

		if (!in_array($the_ID, $_SESSION['voted'])){	
			$score++;

			update_field('field_563a19efbc69d', $score);

			array_push($_SESSION['voted'], $the_ID);
		} else {
			$recommend_errors = 'You have already recommended this build.';
		}
	}
?>
<?php get_header(); ?>


	<!-- Page Content --> 
	<div class="container build-container">

	    <div class="build-main">
	    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    	<?php $championId = get_post_meta(get_the_ID() ,'champion', true);?>


				<div class="build-header">
					<?php get_template_part('template-summary-header-background'); ?>
				    <span class="shadow"></span>

				    <div class="build-header-content">
				    	<div class="title-and-build">
				    		<h2 style="color: #fff;"><?php the_title(); ?></h2>
				    		<p class="build-excerpt"><?php the_excerpt(); ?></p>
				    		<div class="items-list">
				    			<ul>
				    				<?php get_template_part('template-summary-header-summoner') ?>
				    			</ul>
				    		</div>
				    		<div class="items-list">
				    		    <ul>
				    		        <?php get_template_part('template-summary-header-stuff') ?>
				    		    </ul>
				    		</div>
				    	</div>
				    </div>
				    <div class="creator-infos">
				    	<img class="creator-image" src="<?php echo get_template_directory_uri(); ?>/img/champion/Vi.png" alt="">
				    	<a href="http://euw.op.gg/summoner/userName=<?php the_author(); ?>" target="_BLANK"><?php the_author(); ?></a>
				    	<div class="creator-division">
				    		<img src="<?php echo get_template_directory_uri(); ?>/img/division_gold.png" alt="">
				    		<p>Gold V</p>
				    	</div>
				    	<p>Posted <?php echo get_the_date(); ?></p>
				    </div>
				    <a class="back-link" href="<?php echo get_site_url(); ?>/build/" class="pull-right"><i class="icon-arrow-left"></i>Back to builds</a>
				</div>

				<div class="build-content">
					<div class="aside">
						<div class="recommend-button">
							<form action="#" method="POST">
								<input type="hidden" name ="plus" value="un">
								<button type="submit"><i class="fa fa-heart"></i>Recommend this build</button>	
							</form>
							<?php if(!empty($recommend_errors)) : ?>
								<p><?php echo $recommend_errors; ?></p>
							<?php endif; ?>
							<p><i class="fa fa-heart"></i><?php echo $score ?> people recommended this build</p>
						</div>
						<ul class="panel-choice-detail">
							<li class="active"><a href="#panel-1">Summary</a></li>
							<li><a href="#panel-2">Runes</a></li>
							<li><a href="#panel-3">Masteries</a></li>
							<li><a href="#panel-4">Skill order</a></li>
							<li><a href="#panel-5">Gameplay</a></li>
							<li><a href="#panel-6"><?php echo get_comments_number(); ?> Comments</a></li>
						</ul>
					</div>

					<div class="main">
						<div class="panel summary show" id="panel-1">
							<div class="left">
								<div class="panel-section">
									<h3>Full item build</h3>
									<div class="items-list">
										<ul>
											<?php get_template_part('template-summary-stuff'); ?>
										</ul>
									</div>
								</div>
								
								<div class="panel-section">
									<h3>Runes</h3>
									<ul>
										<?php get_template_part('template-summary-runes'); ?>
									</ul>
								</div>
							</div>
							<div class="right">
								<div class="panel-section">
									<h3>Summoner spells</h3>
									<div class="items-list">
										<ul>
											<?php get_template_part('template-summary-summoner') ?>	
										</ul>
									</div>
								</div>
								<div class="panel-section">
									<h3>Starting build</h3>
									<div class="items-list">
										<ul>
											<?php get_template_part('template-summary-beginStuff') ?>	
										</ul>
									</div>
								</div>

								<div class="panel-section">
									<h3>Masteries</h3>
									<div class="masteries-head offense">
										<span>9</span>
										<p>Offense</p>
									</div>
									<div class="masteries-head defense">
										<span>21</span>
										<p>Defense</p>
									</div>
									<div class="masteries-head utility">
										<span>0</span>
										<p>Utility</p>
									</div>
								</div>
							</div>
						</div>

						<div class="panel runes" id="panel-2">
							<h3>Runes</h3>
							<div class="panel-section">
								<?php get_template_part('template-rune'); ?>
							</div>
							<div class="panel-section">
								<?php get_template_part('template-rune-explaination'); ?>
							</div>
						</div>

						<div class="panel masteries" id="panel-3">
							<h3>Masteries</h3>
							<div class="panel-section">
								<?php get_template_part('template-masteries') ?>
							</div>
							<div class="panel-section">
								<p>Like runes, masteries are also adaptable. Grab more magic resist against heavy ap,  Reinforced Armor against nasty crit champions like  Yasuo,  Tryndamere,  Master Yi,  Vayne,  Jinx, and  Swiftness against heavy slows like  Nasus or  Nunu. Against full AD teams  Adaptive Armor is not needed.</p>
								<p>Health per level seals may be preferred over armor per level in your standard page, or ability power over magic resist. Shen has a decent or exceptional AP Ratio on every one of his abilities so AP runes are especially beneficial, but magic resist may be necessary against the enemies AP carry. Attack Speed quints recharge your passive and allow for dueling. Hybrid penetration is useful for armor pen with attack speed and dueling with taunt while magic pen for Sunfire, Thornmail, Vorpal Blade, Wits End, and Taunt.</p>
							</div>
						</div>

						<div class="panel skill-order" id="panel-4">
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
											<img class="spell-order-img" order-img-q src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('q_spell', $championID)['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="1" class="table-line-skill first <?php if( get_field_object('skill_order')['value'][0]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="2" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][1]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="3" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][2]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="4" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][3]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="5" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][4]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="6" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][5]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="7" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][6]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="8" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][7]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="9" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][8]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="10" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][9]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="11" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][10]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="12" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][11]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="13" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][12]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="14" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][13]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="15" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][14]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="16" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][15]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="17" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][16]['line'] == 1 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="18" order-line="1" class="table-line-skill <?php if( get_field_object('skill_order')['value'][17]['line'] == 1 ) echo "active"; ?>"><div></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">W</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-w src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('w_spell',$championId)['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="2" class="table-line-skill first <?php if( get_field_object('skill_order')['value'][0]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="2" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][1]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="3" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][2]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="4" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][3]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="5" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][4]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="6" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][5]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="7" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][6]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="8" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][7]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="9" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][8]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="10" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][9]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="11" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][10]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="12" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][11]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="13" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][12]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="14" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][13]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="15" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][14]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="16" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][15]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="17" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][16]['line'] == 2 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="18" order-line="2" class="table-line-skill <?php if( get_field_object('skill_order')['value'][17]['line'] == 2 ) echo "active"; ?>"><div></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">E</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-e src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('e_spell',$championId)['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="3" class="table-line-skill first <?php if( get_field_object('skill_order')['value'][0]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="2" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][1]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="3" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][2]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="4" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][3]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="5" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][4]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="6" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][5]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="7" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][6]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="8" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][7]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="9" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][8]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="10" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][9]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="11" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][10]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="12" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][11]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="13" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][12]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="14" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][13]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="15" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][14]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="16" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][15]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="17" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][16]['line'] == 3 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="18" order-line="3" class="table-line-skill <?php if( get_field_object('skill_order')['value'][17]['line'] == 3 ) echo "active"; ?>"><div></div></div>
									</div>
									<div class="table-line">
										<p class="table-line-control">R</p>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-r src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('r_spell',$championId)['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="4" class="table-line-skill first <?php if( get_field_object('skill_order')['value'][0]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="2" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][1]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="3" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][2]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="4" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][3]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="5" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][4]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="6" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][5]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="7" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][6]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="8" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][7]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="9" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][8]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="10" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][9]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="11" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][10]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="12" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][11]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="13" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][12]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="14" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][13]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="15" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][14]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="16" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][15]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="17" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][16]['line'] == 4 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="18" order-line="4" class="table-line-skill <?php if( get_field_object('skill_order')['value'][17]['line'] == 4 ) echo "active"; ?>"><div></div></div>
									</div>
									<div class="table-line">
										<span class="table-line-control">∞</span>
										<span class="table-line-image">
											<img class="spell-order-img" order-img-passive src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_field_object('passive',$championId)['value']->ID)); ?>" alt="ability image">
										</span>
										<div order-select order-level="1" order-line="5" class="table-line-skill first <?php if( get_field_object('skill_order')['value'][0]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="2" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][1]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="3" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][2]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="4" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][3]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="5" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][4]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="6" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][5]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="7" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][6]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="8" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][7]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="9" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][8]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="10" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][9]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="11" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][10]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="12" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][11]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="13" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][12]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="14" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][13]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="15" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][14]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="16" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][15]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="17" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][16]['line'] == 5 ) echo "active"; ?>"><div></div></div>
										<div order-select order-level="18" order-line="5" class="table-line-skill <?php if( get_field_object('skill_order')['value'][17]['line'] == 5 ) echo "active"; ?>"><div></div></div>
									</div>
								</div>
							</div>
	
							<!-- <div class="panel-section">
								<div class="table-expl">
									<p class="table-expl-control">Q</p>
									<span class="table-expl-image">
										<img src="<?php echo get_template_directory_uri(); ?>/img/skill-order.png" alt="ability image">
									</span>
									<span class="table-expl-name">Conquering Sands</span>
									<p class="table-expl-text">The turret is a very useful ability when used correctly. 
									It's damage doesn't scale with your ap but it still can hit really hard, surprising your opponents. 
									It's cd is 180 seconds and starts after the turret is destroyed. 
									Also this value is not reduced by cdr so just make sure to not waste your turret on stupid stuff.</p>
									<p class="table-expl-text">Your main skill which allows you to create your soldiers. 
									Notice that  Arise! has the biggest ap scaling out of all Azir's abilities. 
									Now notice that this damage is dealt every time your soldier base attacks. 
									So basically the cd for this damage is your attack speed. 
									This is the main reason for why attack speed is very valuable statistic for  Azir. 
									However there is only one viable item with both ap and attack speed,  Nashor's Tooth. 
									The DPS increase with it is REALLY noticeable in late game if we are trying to dps down a tank, 
									however it's not really needed when the enemy team is squishy because we get a lot of attack speed just from our passive on W. 
									We max this ability second because the reduce of it's cd is very important and noticeable during fights and we gain more attack speed. 
									Making the windows of time when you cannot attack with your soldiers as short as possible is one of the most important part of  Azir gameplay. 
									Having said that it's still not worth maxing before Q so just don't do it. For more concrete usage of this skill, check Tips&Tricks</p>
								</div>
								
							</div> -->
						</div>





						<div class="panel gameplay" id="panel-5">	
							<h3>Gameplay</h3>					
							<div class="the-content">
								<?php the_content(); ?>
							</div>
						</div>
						<div class="panel comments" id="panel-6">
							<?php comments_template(); ?>
						</div>
						
					</div>
				   

				</div>

    		<?php endwhile; else: ?>
    			<p>Rien à afficher</p>
    		<?php endif; ?>

	    </div>

	</div>
	

<?php get_footer(); ?>