<?php get_header(); ?>
    
    <!-- projects Content --> 
    <div class="row">

        <div class="span12 blog">

            <div class="row clearfix">
                <ul class="blog-post-grid">

                	<?php if(have_posts()) :  ?>
                		<?php while ( have_posts() ) : the_post(); ?>
						<!-- Si j'ai des posts, j'affiche cette partie -->

	                    <!-- Blog Post 1 -->
	                    <li class="span3 blog-post-item">
	                        <div class="blog-post-hover hidden-phone hidden-tablet">
								<?php 
									$terms = get_the_terms( $post->ID, 'type');
									if($terms && ! is_wp_error($terms)) : 
										$subject_links = array();
										foreach ($terms as $term) : 
											$subject_links[] = $term->name;
										endforeach;
										$on_draught = join(', ', $subject_links);
									endif;
								?>
	                            <p><a href="<?php the_permalink(); ?>" class="clearfix"><?php the_title(); ?></a>
	                            <a class="category" href=""><?php echo $on_draught; ?></a>

	                            <?php 
	                            	$dateformatstring = 'd F Y';
	                            	$unixtimestamp = strtotime(get_field('date_de_publication'));
	                            ?>
	                            <p>Date : <?php echo date_i18n($dateformatstring, $unixtimestamp); ?></p>
	                            </p>
	                        </div>
	                        <a href="project-single.htm"><?php the_post_thumbnail('img_liste'); ?></a>
	                    </li>
	                <?php endwhile; ?>

	            	<?php else: ?>
	            		<p>Rien à afficher</p>
                	<?php endif; ?>

                </ul>
            </div>
        </div>
    </div>

    </div> <!-- End Container -->

 <?php get_footer(); ?>