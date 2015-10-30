<li class="blog-build-item">
    <img class="champion-portrait" src="<?php echo get_template_directory_uri(); ?>/img/champion/Azir.png" alt="">

    <div class="author-and-date">
        <a class="build-link" href="<?php the_permalink(); ?>" class="clearfix"><?php the_title(); ?></a>

        <p>by <a href="">Popolopo26</a> - <?php echo get_the_date(); ?></p>
    </div>
    <div class="items-list">
        <ul>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/item_3.png" alt=""></li>
        </ul>
    </div>
    
    <div class="likes-and-comments">
        <span><img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" alt=""><p>15</p></span>
        <span><img src="<?php echo get_template_directory_uri(); ?>/img/comment-bubble.png" alt=""><p><?php echo get_comments_number(); ?></p></span>
    </div>
</li>