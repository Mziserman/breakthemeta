<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="<?php bloginfo('charset'); ?>" />
    <?php $title = $wp_query->queried_object->post_name; ?>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

    <!-- CSS -->
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">


    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]--> 

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">

</head>

<body class="home">
    
    <div class="header"><!-- Begin Header -->
  
        <!-- Logo -->
        <div class="logo">
            <!-- <a href="<?php echo get_template_directory_uri(); ?>/archive-build.php"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_site.png" alt="" /></a> -->
            <a href="<?php echo get_site_url(); ?>/build/">NewMeta</a>
        </div>
    
        <!-- Main Navigation -->
        <div class="navigation">
            <div class="navbar">
                <ul class="">
                    <li class="active"><a href="<?php echo get_site_url(); ?>/create-a-new-build/">Create a new build</a></li>
                    <li class="underline login"><a href="">Login</a></li>
                    <?php if(!is_user_logged_in()) :
                        if (get_option('users_can_register')) : ?>
                            <li class="underline register"><a href="#">Register</a></li>
                        <?php endif;
                    endif; ?>
                </ul>
            </div>
        </div>
        <?php wp_login_form(); ?>
    </div><!-- End Header -->
