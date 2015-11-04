<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="<?php bloginfo('charset'); ?>" />
    <?php $title = get_site_url(); ?>
    <title><?php echo 'New Meta'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

    <!-- CSS -->
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

    <?php if ( is_page_template( 'create-build.php' ) ) : ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/create_build.css">
    <?php endif ?>


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
                    <?php $permalink =  get_permalink(); ?>
                    <li class="<?php if (preg_match("(\/build\/)", $permalink)) : echo 'active';  endif;?>"><a href="<?php echo get_site_url(); ?>/build/">Build list</a></li>
                    <li class="<?php if (preg_match("/create-build/", $permalink)) : echo 'active';  endif;?>"><a href="<?php echo get_site_url(); ?>/create-build/">Create a new build</a></li>
                    <?php if(!is_user_logged_in()) { ?>
                        <li class="underline login"><a href="">Login</a></li>
                        <li class="underline register"><a href="#">Register</a></li>
                    <?php }else{ ?>
                         <li class=""><a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php wp_login_form(); ?>

        <div style=""> <!-- Registration -->
                <div id="registerform">
                    <p>Register here</p>
                    <form action="<?php echo site_url('wp-login.php?action=register', 'login_post'); ?>" method="post">
                        <input type="text" name="user_login" placeholder="Username" id="user_login" class="input" />
                        <input type="email" name="user_email" placeholder="Email" id="user_email" class="input"  />
                            <?php do_action('register_form'); ?>
                        <span>You'll receive a mail for confirmation</span>
                        <input type="submit" value="Register" id="register" />
                    </form>
                </div>
        </div><!-- /Registration -->
    </div><!-- End Header -->
