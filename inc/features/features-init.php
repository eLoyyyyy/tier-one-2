<?php

/*Sidebar*/
if ( !function_exists( 'tieronetwo_sidebar' ) ):
    function tieronetwo_sidebar() {

        register_sidebar( array(
            'name' => __( 'Main Sidebar', 'tieronetwo' ),
            'id' => 'main-sidebar',
            'before_widget' => '<section id="%1$s" class="widget %1$s">',
            'after_widget' => '</section>',
            'before_title'  => '<div class="widget-title-container"><h2 class="widget-title">',
            'after_title' => '</h2></div>',
            'description' => __( 'Main Sidebar for Tier-One.2 Theme', 'tieronetwo' ),
        ) );

    }
    add_action( 'after_setup_theme', 'tieronetwo_sidebar' );
endif;

if ( !function_exists( 'header_horizontal_ad_widget' ) ):
    function header_horizontal_ad_widget() {

        register_sidebar( array(
            'name' => __( 'Header Horizontal Ad Widget', 'tieronetwo' ),
            'id' => 'horizontal-ad-head',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<span class="h2 sr-only">',
            'after_title' => '</span>',
            'description' => __( 'Horizontal Ad Widget On Header', 'tieronetwo' ),
        ) );

    } 
    add_action( 'after_setup_theme', 'header_horizontal_ad_widget' );
endif;

if ( !function_exists( 'header_sidebar' ) ):
    function header_sidebar() {

        register_sidebar(array(
            'name' => __( 'Header', 'tieronetwo' ),
            'id' => 'header-sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
            'description' => __( 'Header Sidebar', 'tieronetwo' ),
        ) );

    }
    add_action( 'after_setup_theme', 'header_sidebar' );
endif;

if ( !function_exists( 'footer_content_sidebar' ) ):
    function footer_content_sidebar() {

        register_sidebar( array(
            'name' => __( 'Footer Content Sidebar', 'tieronetwo' ),
            'id' => 'footer_content_sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5 class="white-text">',
            'after_title' => '</h5>',
            'description' => __( 'Footer Content Sidebar', 'tieronetwo' ),
        ) );

    }
    add_action( 'after_setup_theme', 'footer_content_sidebar' );
endif;

/* custom background */ 

global $wp_version;

if ( ! function_exists( 'change_custom_background_cb' ) ) :

function change_custom_background_cb() {
    $background = get_background_image();
    $color = get_background_color();

    if ( ! $background && ! $color )
        return;

    $style = $color ? "background-color: #$color;" : '';

    if ( $background ) {
        $image = " background-image: url('$background');";

        $repeat = get_theme_mod( 'background_repeat', 'repeat' );

        if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
            $repeat = 'repeat';

        $repeat = " background-repeat: $repeat;";

        $position = get_theme_mod( 'background_position_x', 'left' );

        if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
            $position = 'left';

        $position = " background-position: top $position;";

        $attachment = get_theme_mod( 'background_attachment', 'scroll' );

        if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
            $attachment = 'scroll';

        $attachment = " background-attachment: $attachment;";

        $style .= $image . $repeat . $position . $attachment;
    }
?>
<style type="text/css" id="custom-background-css">
    .custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}
if ( version_compare( $wp_version, '3.4', '>=' ) ) {
    add_theme_support( 'custom-background', array( 'wp-head-callback' => 'change_custom_background_cb','default-color' => 'fff' ) );
}
else {
    add_custom_background('change_custom_background_cb');
}

endif;

/* end custom background */

add_theme_support('nav-menus');

add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside','image','video'));
add_theme_support('featured' ,388, 220, true );
add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption'));

register_nav_menus(
    array(
        'primary'   =>  __( 'Primary Menu', 'tier-one-2' ),
        // Register the Primary menu and Drawer menu
        // Theme uses wp_nav_menu() in TWO locations.
        // Copy and paste the line above right here if you want to make another menu,
        // just change the 'primary' to another name
    )
);

register_nav_menus(
    array(
        'footer'   =>  __( 'Footer Menu', 'tier-one-2' ),
        // Register the Primary menu and Drawer menu
        // Theme uses wp_nav_menu() in TWO locations.
        // Copy and paste the line above right here if you want to make another menu,
        // just change the 'primary' to another name
    )
);