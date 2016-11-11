<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head itemscope itemtype="http://schema.org/WebSite">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title itemprop='name'><?php wp_title( '|', true, 'right' ); ?></title>
            <meta name="description" content="<?php bloginfo('description'); ?>">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
            <link rel="canonical" href="<?php bloginfo('url'); ?>">

            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <?php if ( is_active_sidebar( 'header-sidebar' ) ) : 
                    dynamic_sidebar( 'header-sidebar' ); 
            endif; ?> 
            <?php wp_head(); ?>
        </head>

        <body class="custom-background" itemscope itemtype="http://schema.org/WebPage" itemprop="mainContentOfPage">
            <!--[if lt IE 9]>
                <script>
                    document.createElement("header" );
                    document.createElement("footer" );
                    document.createElement("section"); 
                    document.createElement("aside"  );
                    document.createElement("nav"    );
                    document.createElement("article"); 
                    document.createElement("hgroup" ); 
                    document.createElement("time"   );
                </script>
                <noscript>
                    <strong>Warning !</strong>
                    Because your browser does not support HTML5, some elements are created using JavaScript.
                    Unfortunately your browser has disabled scripting. Please enable it in order to display this page.
                </noscript>
                <![endif]-->
            
            <?php 
                if ( function_exists('facebook_javascript_sdk') && is_single() ) :
                    facebook_javascript_sdk(); 
                endif; 
            ?>
            
            <div class="preloader valign-wrapper blue-grey darken-4">
                <div class="preloader-wrapper valign big active" style="margin: 0 auto;">
                    <div class="spinner-layer spinner-white-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <header class="container">
                <div class="container-navbar">
                    <div class="row">
                        <?php $lsix = ( is_active_sidebar( 'horizontal-ad-head' ) ) ? 'l4' : 'l12'; ?>
                        <div class="col <?php echo $lsix; ?> m12 s12 center-align">
                            <?php  
                                $logo = get_theme_mod( 'site_logo', '' );
                                $title_option = get_theme_mod( 'site_title_option', 'text-only' );

                                if ( $title_option == 'logo-only' && ! empty($logo) ) { ?>
                                    <div class="site-logo">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"></a>
                                    </div>
                                <?php } 

                                if ( $title_option == 'text-logo' && ! empty($logo) ) { ?>
                                    <div class="site-logo">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"></a>
                                    </div>
                                    <div class="site-title-text">
                                            <h1 class="h2" itemprop="headline"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                            <h2 class="h5" itemprop="description"><?php bloginfo( 'description' ); ?></h2>
                                    </div>
                                <?php } 

                                if ( $title_option == 'text-only' ) { ?>
                                    <div class="site-title-text">
                                            <h1 class="h2" itemprop="headline"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                            <h2 class="h5" itemprop="description"><?php 
                                                if(empty(bloginfo( 'description' ))):
                                                   echo "&nbsp;";
                                                else:
                                                   bloginfo( 'description' ); 
                                                endif;
                                            ?></h2>
                                    </div>
                            <?php } ?>
                        </div>
                        <?php if ( $lsix ) : ?>
                            <div class="col l8 m12 s12">
                                <div class="header-ad">
                                    <?php dynamic_sidebar( 'horizontal-ad-head' ); ?> 
                                </div><!--header ad-->
                            </div>
                        <?php endif; ?> 
                    </div>
                </div>
            </header>
            <nav class="container blue-grey darken-4 margin-top-fix" itemscope itemtype='http://schema.org/SiteNavigationElement'>
                <h1 class="sr-only">Header Navigation</h1>
                <div class="container-navbar nav-wrapper">
                    <div class="row">
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <div class="col l12 m12 s12">
                            <?php 
                                 wp_nav_menu( array(
                                     'container'=> false,
                                    'theme_location'=>'primary',
                                    'menu_class' => 'hide-on-med-and-down',
                                    'walker' => new wp_materialize_navwalker()
                                ));
                            ?>
                        </div>
                        <!-- col s4
                        <div class="col l4 hide-on-med-and-below">
                            <?php //get_search_form(); ?>
                        </div>  -->
                        
                        <!-- submenu -->
                        <?php create_materialize_submenu('primary'); ?>
                        <!-- end submenu -->
                    </div>
                </div>
            </nav>