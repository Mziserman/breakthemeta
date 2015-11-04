<?php 
    $champion = get_field_object('champion')['value'];
    $score = get_field_object('likes')['value'];

?>

<li class="blog-build-item">
    <?php echo get_the_post_thumbnail($champion->ID, 'full',['class' => 'champion-portrait']) ?>
    <div class="author-and-date">
        <a class="build-link" href="<?php the_permalink(); ?>" class="clearfix" target="_BLANK"><?php the_title(); ?></a>

        <p>by <a href="http://euw.op.gg/summoner/userName=<?php the_author(); ?>" target="_BLANK"><?php the_author(); ?></a> - <?php echo get_the_date(); ?></p>
    </div>
    <div class="items-list">
        <ul>
            <?php get_template_part('template-summary-header-stuff') ?>
        </ul>
    </div>
    
    <div class="likes-and-comments">
        <span><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" alt=""><p><?php echo $score; ?></p></span>
        <span><img src="<?php echo get_template_directory_uri(); ?>/img/comment-bubble.png" alt=""><p><?php echo get_comments_number(); ?></p></span>
    </div>
</li>