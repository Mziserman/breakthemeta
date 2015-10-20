<?php get_header(); ?>

	<!-- Page Content --> 
	<div class="row">

	    <!-- Gallery Items --> 
	    <div class="span12 gallery-single">

	        <div class="row">
	            <div class="span6">
	                <?php the_post_thumbnail('img_liste'); ?>
	            </div>
	            <div class="span6">
	                <h2 style="color: #fff;"><?php the_title(); ?></h2>
	                <p><?php get_the_content(); ?></p>

	                <ul class="project-info">
	                    <li>Coucou c'est bien un build de Lol</li>
	                </ul>

	                <a href="projects.htm" class="pull-right"><i class="icon-arrow-left"></i>Retour aux projets</a>
	            </div>
	        </div>

	    </div><!-- End gallery-single-->

	</div><!-- End container row -->
	
	</div> <!-- End Container -->

<?php get_footer(); ?>