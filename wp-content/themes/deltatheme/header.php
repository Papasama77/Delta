<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

    <!--Crochet qui permet de charger ici les styles configurés dans functions.php-->
    <?php wp_head();?>
    
</head>

<!--body_class(); = permet de prendre en compte les classes insérés dans les articles, les pages, les widgets, les extensions...-->
<body <?php body_class();?>>
<?php wp_body_open(); ?>
    <main id="fullorboxed" class="<?php if(get_theme_mod('largeur_site')=='container'){echo esc_attr(get_theme_mod('largeur_site','container'));}
    else{echo esc_attr(get_theme_mod('largeur_site','container-fluid'));}?>">
    
<!--TOP BAR-->
    <section id="topbar" class="row <?php if(get_theme_mod('active_topbar')=='top-bar'){echo esc_attr(get_theme_mod('active_topbar','top-bar'));}
    else{echo esc_attr(get_theme_mod('active_topbar','hidden'));}?>">
        <div class="col-md-4">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/icone-tel.png" alt="appeler Delta theme">
            <span><?php if(get_theme_mod('display_phone_number')==true){echo esc_html(get_theme_mod('phone_number','+33(0) 12 434 434'));}?></span>
        </div>

        <div class="col-md-8">
        
            <nav class="navbar navbar-expand-md" role="navigation">
                <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-2" aria-controls="bs-example-navbar-collapse-2" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'deltatheme' ); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
        <?php
           wp_nav_menu( array(
            'theme_location'  => 'topbar',
            'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'bs-example-navbar-collapse-2',
            'menu_class'      => 'navbar-nav mr-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));
        ?>
            </div>
        </nav>
    </div>
    </section>

<!--HEADER-->
<header class="d-flex">
    <div>
        <nav class="navbar navbar-expand-md" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'deltatheme' ); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
        <?php
           wp_nav_menu( array(
            'theme_location'  => 'main',
            'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'bs-example-navbar-collapse-1',
            'menu_class'      => 'navbar-nav mr-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));
        ?>
            </div>
        </nav>
    </div>

        
    <a href="<?php echo esc_url(home_url());?>">
        <div class="logo"></div>
    </a>

    <div class="social">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/Blancs/facebook.png" alt="Suivez nous sur Facebook">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/Blancs/twitter.png" alt="Suivez nous sur Twitter">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/Blancs/instagram.png" alt="Suivez nous sur Instagram">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/Blancs/pinterest.png" alt="Suivez nous sur Pinterest">
            <img src="<?php echo get_stylesheet_directory_uri();?>/img/icons/Blancs/flux_rss.png" alt="Abonnez vous à notre flux rss">
    </div>
   <div>
       <?php get_search_form(); ?>
      
  </div>
</header>

