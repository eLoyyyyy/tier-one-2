<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

    
    <footer class="container page-footer blue-grey darken-4 margin-top-fix" itemscope itemtype="http://schema.org/WPFooter">
        <div class="container-navbar">
            <div class="row">
                <div class="col l6 s12">
                    <!-- <h5 class="white-text">ABOUT US</h5>
                    <p class="grey-text text-lighten-4">File not found. Hey! I'm a porno-dealing monster, what do I care what you think? Yeah, and if you were the pope they'd be all, "Straighten your pope hat." And "Put on your good vestments." Bender, being God isn't easy. If you do too much, people get dependent on you, and if you do nothing, they lose hope. You have to use a light touch. Like a safecracker, or a pickpocket.</p>
                    <p class="grey-text text-lighten-4">Goodbye, friends. I never thought I'd die like this. But I always really hoped. Then we'll go with that data file! I videotape every customer that comes in here, so that I may blackmail them later. But existing is basically all I do!</p>
                    -->
                    <?php if ( is_active_sidebar( 'footer_content_sidebar' ) ) : 
                            dynamic_sidebar( 'footer_content_sidebar' ); 
                    endif; ?> 
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">QUICK LINKS</h5>
                    <?php
                    
                            wp_nav_menu(
                                array(
                                    'container'         => false,
                                    "theme_location"    => "footer",
                                    "walker"            => new Wpse8170_Menu_Walker(),
                                )
                            );
                    
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-copyright blue-grey darken-3">
            <div class="container">
                <small>&copy;<?php _e( sprintf(' %s Copyright ', tonetwo_copyright() ), 'tieronetwo'); ?>Tier 1</small>
                <small class="right">
                    <?php _e( 
                        sprintf('Designed by <a class="grey-text text-lighten-4" href="%s">%s</a>. All Rights Reversed.', 
                                '#!', 
                                'Melvin Arbis')
                    ,'tieronetwo')?>
                </small>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <?php if ( is_active_sidebar( 'palawit_sidebar' ) ) : 
            dynamic_sidebar( 'palawit_sidebar' ); 
    endif; ?> 
    </body>
</html>