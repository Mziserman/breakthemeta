<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="<?php bloginfo('charset'); ?>" />
    <title><?php the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

    <!-- CSS -->
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom-styles.css">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]--> 

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">

    <!-- JS -->
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.custom.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.quicksand.js"></script>
</head>

<body class="home">
    <!-- Color Bars (above header)-->
    <div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container">
    
        <div class="row header"><!-- Begin Header -->
      
            <!-- Logo -->
            <div class="span3 logo">
                <a href="index.htm"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" /></a>
            </div>
        
            <!-- Main Navigation -->
            <div class="span9 navigation">
                <div class="navbar hidden-phone">
                    <ul class="nav">
                        <li class="active"><a href="index.htm">Accueil</a></li>
                        <li><a href="gallery-4col.htm">Builds</a></li>
                        <li><a href="blog-style2.htm">Profil</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=register"><?php _e('Register') ?></a></li>
                        <li><a href="<?php echo wp_login_url(); ?>">Se connecter</a></li>
                        <li><a href="page-contact.htm">Proposer</a></li>
                    </ul>
                </div>

                <!-- Mobile Nav -->
                <form action="#" id="mobile-nav" class="visible-phone">
                    <div class="mobile-nav-select">
                        <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                            <option value="">Menu...</option>
                            <option value="index.htm">Accueil</option>
                            <option value="gallery-4col.htm">Films</option>
                            <option value="projects.htm">Blog</option>
                            <option value="projects.htm">Projets</option>
                            <option value="page-contact.htm">Proposer</option>
                        </select>
                    </div>
                </form>
            </div>
        </div><!-- End Header -->