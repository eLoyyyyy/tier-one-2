<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

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

function tieronetwo_customize_register($wp_customize)
{
	/**
	 * Header Settings Panel
	 */
	$wp_customize->add_panel( 
		'tierone_header_settings', 
		array(
			'title' => __( 'Header Settings', 'tieronetwo' ),
			'description' => __( 'Use this panel to set your header settings', 'tierone' ),
			'priority' => 25, 
		) 
	);


	// Logo image
    $wp_customize->add_setting(
        'site_logo',
        array(
            'sanitize_callback' => 'tieronetwo_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'         => __( 'Site Logo', 'tieronetwo' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_logo',
                'description' 	=> __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'tierone' ),
            )
        )
    );

    // Logo, title and description chooser
    $wp_customize->add_setting(
        'site_title_option',
        array (
            'default'           => 'text-only',
            'sanitize_callback' => 'tieronetwo_sanitize_logo_title_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'site_title_option',
        array(
            'label'     	=> __( 'Display site title / logo.', 'tieronetwo' ),
            'section'   	=> 'title_tagline',
            'type'      	=> 'radio',
            'description'	=> __( 'Choose your preferred option.', 'tieronetwo' ),
            'choices'   => array (
                'text-only' 	=> __( 'Display site title and description only.', 'tierone' ),
                'logo-only'     => __( 'Display site logo image only.', 'tierone' ),
                'text-logo'		=> __( 'Display both site title and logo image.', 'tierone' ),
                'display-none'	=> __( 'Display none', 'tierone' )
            )
        )
    );

   /* // Site favicon
	$wp_customize->add_setting(
        'site_favicon',
        array(
            'sanitize_callback' => 'tierone_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
                'label'         => __( 'Upload a favicon', 'tierone' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_favicon',
                'description' 	=> __( 'Upload a favicon for your website.', 'tierone' ),
            )
        )
    );

    // Display site favicon?
    $wp_customize->add_setting(
		'display_site_favicon',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'tierone_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_site_favicon',
		array(
			'settings'		=> 'display_site_favicon',
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display site favicon?', 'tierone' ),
		)
	);*/
}
add_action( 'customize_register', 'tieronetwo_customize_register' );

function tieronetwo_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

function tieronetwo_sanitize_logo_title_select( $logo_option ) {
	if ( ! in_array( $logo_option, array( 'text-only', 'logo-only', 'text-logo', 'display-none' ) ) ) {
        $logo_option = 'text-description-only';
    } 

    return $logo_option;
}

function custom_loginlogo() {
    $logo = get_theme_mod( 'site_logo', '' );
    if( !empty( $logo ) ) :
        list($width, $height, $type, $attr) = getimagesize($logo); 
        ?>
        <style type="text/css">
            .login h1 a {
                width: <?php echo $width; ?>px; 
                height: <?php echo $height; ?>px; 
                background-image: url('<?php echo esc_url( $logo ); ?>') !important; 
                background-size: <?php echo $width; ?>px auto;
            }
        </style>
        <?php
    endif;
}
add_action('login_head', 'custom_loginlogo');