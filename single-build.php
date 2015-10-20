<?php get_header(); ?>

	<!-- Page Content --> 
	<div class="container">

	    <!-- Gallery Items --> 

	    <div class="gallery-single">

	    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="">
				    <?php the_post_thumbnail('img_liste'); ?>
				</div>
				<div class="">
				    <h2 style="color: #fff;"><?php the_title(); ?></h2>
				    <p><?php the_content(); ?></p>

				    <ul class="project-info">
				        <li>Coucou c'est bien un build de Lol</li>
				    </ul>

				   
				</div>

    		<?php endwhile; else: ?>
    			<p>Rien à afficher</p>
    		<?php endif; ?>

	         <a href="projects.htm" class="pull-right"><i class="icon-arrow-left"></i>Retour aux projets</a>

	    </div><!-- End gallery-single-->

	</div>
	

<?php get_footer(); ?>