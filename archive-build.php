<?php get_header(); ?>
    
    <div class="container archive-container">

    	<div class="aside">

    		<div class="filters">
    			<p>Filtres</p>
    		</div>

    		<div class="aside-list-items">
    			<div class="champions">
    				<div class="title">Champions</div>
    				<div class="search-champion">
    					<form action=""><input type="search" class="search-field" name="search-champ" id="search-champ" placeholder="Search champion"><button type="submit"><i class="fa fa-search"></i></button></form>
    				</div>
    				<div class="champ-list">
    					<ul>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Aatrox.png" alt=""><span class="champ-name">Aatrox</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Ahri.png" alt=""><span class="champ-name">Ahri</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Akali.png" alt=""><span class="champ-name">Akali</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Alistar.png" alt=""><span class="champ-name">Alistar</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Amumu.png" alt=""><span class="champ-name">Amumu</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Anivia.png" alt=""><span class="champ-name">Anivia</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Annie.png" alt=""><span class="champ-name">Annie</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Ashe.png" alt=""><span class="champ-name">Ashe</span></a></li>
    						<li class="champ-list-item active"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Azir.png" alt=""><span class="champ-name">Azir</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Blitzcrank.png" alt=""><span class="champ-name">Blitzcrank</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Brand.png" alt=""><span class="champ-name">Brand</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Braum.png" alt=""><span class="champ-name">Braum</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Caitlyn.png" alt=""><span class="champ-name">Caitlyn</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Corki.png" alt=""><span class="champ-name">Corki</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Darius.png" alt=""><span class="champ-name">Darius</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Diana.png" alt=""><span class="champ-name">Diana</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Draven.png" alt=""><span class="champ-name">Draven</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/DrMundo.png" alt=""><span class="champ-name">Mundo</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Elise.png" alt=""><span class="champ-name">Elise</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Evelynn.png" alt=""><span class="champ-name">Evelynn</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Ezreal.png" alt=""><span class="champ-name">Ezreal</span></a></li>
    						<li class="champ-list-item"><a href=""><span class="shadow"></span><img src="<?php echo get_template_directory_uri(); ?>/img/champion/Fiora.png" alt=""><span class="champ-name">Fiora</span></a></li>
    					</ul>
    				</div>
    			</div>
    			<div class="lanes">
    				<a class="title" href="">Lanes<!-- <i class="fa fa-plus"></i> --><span class="plus"></span></a>
    				<div class="filter-list">
    					<ul>
    						<li><a href="">Toplane</a></li>
    						<li><a href="">Jungle</a></li>
    						<li><a href="">Mid</a></li>
    						<li><a href="">Bottom</a></li>
    					</ul>
    				</div>
    			</div>
    			<div class="roles">
    				<a class="title" href="">Roles<!-- <i class="fa fa-plus"></i> --><span class="plus"></span></a>
    				<div class="filter-list">
    					<ul>
    						<li><a href="">Carry AP</a></li>
    						<li><a href="">Carry AD</a></li>
    						<li><a href="">Tank</a></li>
    						<li><a href="">Support</a></li>
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
                        <li class="active"><a href="#date">Newest</a></li>
                        <li><a href="#rating">Top rated</a></li>
                        <li><a href="#panel-3">Debated</a></li>
                    </ul>
                </div>
                <div class="build-list-content">
                    <div class="panel show" id="panel-1">
                        <ul>
                            <?php                             
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                    get_template_part('template_archive_build');
                                endwhile; endif;
                            ?>
                        </ul>
                    </div>
                    <div class="panel" id="panel-2">
                        <ul>
                            
                        </ul>
                    </div>
                    <div class="panel" id="panel-3">Debated build list</div>
                </div>
            </div>
        </div>

    </div>

 <?php get_footer(); ?>