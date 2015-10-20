<?php get_header(); ?>
    
    <?php if (have_posts()) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<!-- Si j'ai des posts, j'affiche cette partie -->
				<h3><?php the_title(); ?></h3>
				<?php 
					the_post_thumbnail();
					the_content();
				 ?>
			<?php endwhile; ?>

	<?php else :  ?>
			<!-- Si pas de posts, j'affiche cette partie -->
			<p>HIUZIUVPIONZUTOIEVUNPCEIZYI</p>
	<?php endif; ?>

 <?php get_footer(); ?>