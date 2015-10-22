<?php get_header(); ?>

	<!-- Page Content --> 
	<div class="container build-container">

	    <div class="build-main">
	    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="build-header">
				    <img class="build-header-bg" src="<?php echo get_template_directory_uri(); ?>/img/azir_splash.png" alt="">
				    <span class="shadow"></span>

				    <div class="build-header-content">
				    	<div class="creator-infos">
				    		<img class="creator-image" src="<?php echo get_template_directory_uri(); ?>/img/champion/Vi.png" alt="">
				    		<a href="">Popolopo26</a>
				    		<div class="creator-division">
				    			<img src="<?php echo get_template_directory_uri(); ?>/img/division_gold.png" alt="">
				    			<p>Gold V</p>
				    		</div>
				    		<p>Posted <?php echo get_the_date(); ?></p>
				    	</div>
				    	<div class="title-and-build">
				    		<h2 style="color: #fff;"><?php the_title(); ?></h2>
				    		<p><?php echo the_excerpt(); ?></p>
				    		<div class="items-list">
				    			<ul>
				    				<li><img src="<?php echo get_template_directory_uri(); ?>/img/sum_exhaust.png" alt=""></li>
				    				<li><img src="<?php echo get_template_directory_uri(); ?>/img/sum_flash.png" alt=""></li>
				    			</ul>
				    		</div>
				    		<div class="items-list">
				    		    <ul>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_1.png" alt=""></li>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_2.png" alt=""></li>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_4.png" alt=""></li>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_5.png" alt=""></li>
				    		        <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_6.png" alt=""></li>
				    		    </ul>
				    		</div>
				    	</div>
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
							<li><a href="#panel-6">6 comments</a></li>
						</ul>
					</div>

					<div class="main">
						<div class="panel summary show" id="panel-1">
							<div class="panel-section">
								<h3>Full item build</h3>
								<p><?php the_content(); ?></p>
							</div>
							<div class="panel-section">
								<h3>Runes</h3>
								<p>Voilà des runes</p>
							</div>
							<div class="panel-section">
								<h3>Summoner spells</h3>
								<p>Eh mes 2 summoners</p>
							</div>
							<div class="panel-section">
								<h3>Starting build</h3>
								<p>Surement une doran blade, toujours une doran blade.</p>
							</div>
						</div>

						<div class="panel runes" id="panel-2">
							<p>La c'est la panel 2 mais c'est un peu du troll aussi</p>
						</div>

						<div class="panel masteries" id="panel-3">
							<p>Coucou le panel des masteries !</p>
						</div>
						<div class="panel skill-order" id="panel-4">
							<p>Roll your face it will work, TRUST ME</p>
						</div>
						<div class="panel gameplay" id="panel-5">
							<p>Non mais vraiment du gameplay pour jouer GP ?</p>
						</div>
						<div class="panel comments" id="panel-6">
							<p>Hum des commentaires ici</p>
						</div>
						
					</div>
				   

				</div>

    		<?php endwhile; else: ?>
    			<p>Rien à afficher</p>
    		<?php endif; ?>

	    </div>

	</div>
	

<?php get_footer(); ?>