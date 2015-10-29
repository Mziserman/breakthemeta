<?php get_header(); ?>

	<!-- Page Content --> 
	<div class="container build-container">

	    <div class="build-main">
	    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="build-header">
				    <img class="build-header-bg" src="<?php echo get_template_directory_uri(); ?>/img/azir_splash.png" alt="">
				    <span class="shadow"></span>

				    <div class="build-header-content">
				    	<div class="title-and-build">
				    		<h2 style="color: #fff;"><?php the_title(); ?></h2>
				    		<p class="build-excerpt"><?php echo the_excerpt(); ?></p>
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
				    	<a href="">Popolopo26</a>
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
							<button><i class="fa fa-heart"></i>Recommend this build</button>
							<p><i class="fa fa-heart"></i>15 people recommended this build</p>
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
								<div class="offense-section">
									<div class="masteries-head offense">
										<span>9</span>
										<p>Offense</p>
									</div>
									<div class="masteries-table offense">
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/1-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="4">4/4</span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/3-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="2">2/3</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/4-5.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/1-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/3-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="3">3/3</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/4-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/1-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/3-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/4-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/1-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/3-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/4-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/1-5.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-5.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col"></div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/4-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col"></div>
											
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/offense/2-6.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col"></div>
											<div class="col"></div>
										</div>
									</div>
								</div>
								
								<div class="defense-section">
									<div class="masteries-head defense">
										<span>21</span>
										<p>Defense</p>
									</div>
									<div class="masteries-table defense">
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/1-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="2">2/2</span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/1-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="2">2/2</span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/1-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/1-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/2-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/3</span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/2-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="3">3/3</span>
												</a>
											</div>
											<div class="col"></div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/2-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/3-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/1</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/3-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/1</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/3-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="3">3/3</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/3-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/3</span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/4-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/4-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/1</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/4-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/1</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/4-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/5-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/5-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="4">4/4</span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/5-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col"></div>
										</div>
										<div class="row">
											<div class="col"></div>
											
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/defense/6-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="1">1/1</span>
												</a>
											</div>
											<div class="col"></div>
											<div class="col"></div>
										</div>
									</div>
								</div>

								<div class="utility-section">
									<div class="masteries-head utility">
										<span>0</span>
										<p>Utility</p>
									</div>
									<div class="masteries-table utility">
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/1-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/1-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/1-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/1-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col"></div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/2-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="" class="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/2-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/2-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/3-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/3-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/3-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/3-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/4-1.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/4-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/4-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/4-4.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col"></div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/5-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/5-3.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col"></div>
										</div>
										<div class="row">
											<div class="col"></div>
											<div class="col">
												<a href="">
													<img src="<?php echo get_template_directory_uri(); ?>/img/masteries/utility/6-2.png" alt="">
													<span class="shadow"></span>
													<span class="points" data-point="0"></span>
												</a>
											</div>
											<div class="col"></div>
											<div class="col"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-section">
								<p>Like runes, masteries are also adaptable. Grab more magic resist against heavy ap,  Reinforced Armor against nasty crit champions like  Yasuo,  Tryndamere,  Master Yi,  Vayne,  Jinx, and  Swiftness against heavy slows like  Nasus or  Nunu. Against full AD teams  Adaptive Armor is not needed.</p>
								<p>Health per level seals may be preferred over armor per level in your standard page, or ability power over magic resist. Shen has a decent or exceptional AP Ratio on every one of his abilities so AP runes are especially beneficial, but magic resist may be necessary against the enemies AP carry. Attack Speed quints recharge your passive and allow for dueling. Hybrid penetration is useful for armor pen with attack speed and dueling with taunt while magic pen for Sunfire, Thornmail, Vorpal Blade, Wits End, and Taunt.</p>
							</div>
						</div>

						<div class="panel skill-order" id="panel-4">
							<p>Roll your face it will work, TRUST ME</p>
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