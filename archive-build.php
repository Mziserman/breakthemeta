<?php get_header(); ?>
    
    <div class="container archive-container">

    	<div class="aside">

    		<div class="filters">
    			<p>Filters</p>
    		</div>

    		<div class="aside-list-items">
    			<div class="champions">
    				<div class="title">Champions</div>
    				<div class="search-champion">
    					<form action=""><input champion-search type="search" class="search-field" name="search-champ" id="search-champ" placeholder="Search champion"><button type="submit"><i class="fa fa-search"></i></button></form>
    				</div>
    				<div class="champ-list">
    					<ul>
                            <?php
                                $args = array('post_type' => 'champion','posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC');
                                $the_query = new WP_Query( $args );
                            ?>
                            <?php if ($the_query->have_posts()) : ?>
                                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <!-- Gallery Item -->
                                    <li  class="champ-list-item" champion-select><a href="<?php echo the_ID(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <span class="shadow"></span>
                                            <span><?php the_post_thumbnail('champion_liste'); ?></span>
                                            <span class="champion-name"><?php the_title() ?></span>
                                        <?php endif ?>
                                    </li></a>
                                <?php endwhile; ?>
                            <?php endif; ?>
    					</ul>
    				</div>
    			</div>
    			<div class="lanes">
    				<a class="title" href="">Lanes<!-- <i class="fa fa-plus"></i> --><span class="plus"></span></a>
    				<div class="filter-list">
    					<ul>
    						<li><a href="top">Toplane</a></li>
    						<li><a href="jungle">Jungle</a></li>
    						<li><a href="mid">Mid</a></li>
    						<li><a href="bottom">Bottom</a></li>
    					</ul>
    				</div>
    			</div>
    			<div class="roles">
    				<a class="title" href="">Roles<!-- <i class="fa fa-plus"></i> --><span class="plus"></span></a>
    				<div class="filter-list">
    					<ul>
    						<li><a href="carry_ap">Carry AP</a></li>
    						<li><a href="carry_ad">Carry AD</a></li>
    						<li><a href="tank">Tank</a></li>
    						<li><a href="support">Support</a></li>
    					</ul>
    				</div>
    			</div>
    		</div>
    		
    	</div>
    	
        <div class="main-archive">

            <div class="search-bar">
                <form action="">
                    <button type="submit"><i class="fa fa-search fa-2x"></i></button>
                    <input type="search" name="search-build" id="search-build" placeholder="Search">
                </form>
            </div>

            <div class="build-list">
                <div class="build-list-header">
                    <ul class="panel-choice">
                        <li class="date active"><a href="date">Newest</a></li>
                        <li class="like"><a href="like">Top rated</a></li>
                        <li class="search-result" style="display: none"><a href="search-result">Search Result</a></li>
                    </ul>
                </div>
                <div class="build-list-content">
                    <div class="panel show" id="panel-1">
                        <ul>
                            <?php                             
                                if ( have_posts() ) : 
                                    while ( have_posts() ) : the_post();
                                        get_template_part('template_archive_build');
                                    endwhile; 
                                else:
                                    echo '<p>No results found.</p>';
                                endif;
                            ?>
                        </ul>
                    </div>
                    <div class="panel hide" id="panel-2">
                        <ul>
                            
                        </ul>
                    </div>
                    <div class="panel hide" id="panel-3">
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

 <?php get_footer(); ?>