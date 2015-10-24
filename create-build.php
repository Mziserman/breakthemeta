<?php 
	/* Template name: Create build */
	get_header();
?>

	<div class="container create-build-container">
		
		<!-- <div class="build-header">
		    <img class="build-header-bg" src="<?php echo get_template_directory_uri(); ?>/img/home-bg.png" alt="">
		    <span class="shadow"></span>

		    <div class="build-header-content">
		    	<div class="title-and-build">
		    		<h2 style="color: #fff;"><?php the_title(); ?></h2>
		    		<p class="build-excerpt"><?php echo the_content(); ?></p>
		    	</div>
		    </div>
		</div> -->

		<div class="build-content">
			<div class="aside">
				<div class="recommend-button">
					<button><i class="fa fa-check-square"></i>Submit this build</button>
					<p>He will apear soon on the site</p>
				</div>
				<ul class="panel-choice-detail">
					<li class="active"><a href="#panel-1">Champion</a></li>
					<li><a href="#panel-2">Items</a></li>
					<li><a href="#panel-3">Spells</a></li>
					<li><a href="#panel-4">Masteries</a></li>
					<li><a href="#panel-5">Runes</a></li>
					<li><a href="#panel-6">Gameplay</a></li>
				</ul>
			</div>
			<div class="main">
				<div class="panel show" id="panel-1">
					<div class="panel-section">
						<h3>Guide title</h3>
					</div>
					<h3>Description</h3>
					<h3>Champion</h3>
				</div>

				<div class="panel" id="panel-2">
					<h3>Test</h3>
				</div>

				<div class="panel" id="panel-3">
					<h3>Test</h3>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>