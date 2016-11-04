<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

require get_template_directory() . '/inc/features/reset.php';

require get_template_directory() . '/inc/features/helpers.php';

require get_template_directory() . '/inc/features/features-init.php';

function tier_one_two_styles_scripts(){
    wp_register_style('tier-one-two-style', get_stylesheet_directory_uri() . '/css/style.min.css');
    wp_enqueue_style('tier-one-two-style');
    wp_register_script('tier-one-two-script', get_stylesheet_directory_uri() . '/js/scripts.min.js');
    wp_enqueue_script('tier-one-two-script');
    
    /* rating system */ 
    wp_localize_script('tier-one-two-script', 'ajax_var', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce')
    ));
    /* end rating system */
    
    wp_enqueue_style('google-noto', 'https://fonts.googleapis.com/css?family=Noto+Serif');
    wp_enqueue_style('material-icon', 'http://fonts.googleapis.com/icon?family=Material+Icons');
}
add_action('wp_enqueue_scripts', 'tier_one_two_styles_scripts');

/*** Remove Query String from Static Resources ***/
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) || strpos( $src, '&ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    
    return esc_url($src);
}
add_filter( 'style_loader_src', 'remove_cssjs_ver');
add_filter( 'script_loader_src', 'remove_cssjs_ver');


require get_stylesheet_directory() . '/inc/features/walkers.php';

require get_template_directory() . '/inc/features/widgets/containerless-widget.php';

require get_template_directory() . '/inc/features/widgets/archive.php';

require get_template_directory() . '/inc/features/view-system.php';

require get_template_directory() . '/inc/features/breadcrumbs.php';

require get_template_directory() . '/inc/features/material-comments.php';

require get_stylesheet_directory() . '/inc/features/like-system.php';

require get_stylesheet_directory() . '/inc/features/widgets/banner-promo-ads-widget.php';

require get_stylesheet_directory() . '/inc/features/widgets/banner_ad_widgets_two.php';

require get_stylesheet_directory() . '/inc/features/widgets/social-media-widget.php';

require get_stylesheet_directory() . '/inc/features/widgets/top-rated-widget.php';

function my_admin_theme_style() {
    wp_enqueue_style('tonetwo-css', get_template_directory_uri().'/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');