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
	                <h2><?php the_title(); ?></h2>
	                <p><?php get_the_content(); ?></p>

	                <ul class="project-info">
	                    <li><h6>Date de publication :</h6> 09/12/15</li>
	                </ul>

	                <a href="projects.htm" class="pull-right"><i class="icon-arrow-left"></i>Retour aux projets</a>
	            </div>
	        </div>

	    </div><!-- End gallery-single-->

	</div><!-- End container row -->
	
	</div> <!-- End Container -->

<?php get_footer(); ?>