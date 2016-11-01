<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

function change_avatar_css($class) {
    $class = str_replace("class='avatar", "class='avatar circle left z-depth-1", $class) ;
    return $class;
}
add_filter('get_avatar','change_avatar_css');
 

function tierone_tags(){
    $posttags = get_the_tags();
    if ($posttags) {
        foreach($posttags as $tag) {
            ?><a rel="tags" href="<?php echo get_tag_link($tag->term_id);?>"><span itemprop="keywords"><?php echo $tag->name;?></span></a>, <?php
        }
    }
}

function tonetwo_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
        SELECT
            YEAR(min(post_date_gmt)) AS firstdate,
            YEAR(max(post_date_gmt)) AS lastdate
        FROM
            $wpdb->posts
        WHERE
            post_status = 'publish'
    ");
    $output = '';
    if($copyright_dates) {
        $copyright = $copyright_dates[0]->firstdate;
        if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= ' - ' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}

function custom_image_sizes(){
    add_image_size( 'trend-size', 217, 234, true );
    
}
add_action( 'after_setup_theme', 'custom_image_sizes');

function get_first_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<img .+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = $matches[1][0]; 
    if ( empty( $first_img ) || is_null( $first_img ) ) :
        // defines a fallback imaage
        $first_img = get_template_directory_uri() . "/images/default.jpg";
    endif;

    return $first_img;
}

remove_filter( 'the_excerpt', 'wpautop' );

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function __language_attributes($lang){

  // ignore the supplied argument
  $langs = array( 'id', 'vi', 'ms', 'en' );

  // change to whatever you want
  $my_language = $langs[0];

  // return the new attribute
  return 'lang="'.$my_language.'"';
}
add_filter('language_attributes', '__language_attributes');

function yst_wpseo_change_og_locale( $locale ) {
 	return 'id_ID'; // vi_VN , ms_MY
}
add_filter( 'wpseo_locale', 'yst_wpseo_change_og_locale' );

function jquery_enqueue_with_fallback() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , '//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js', false, '1.12.0', true );
    wp_add_inline_script( 'jquery', 'window.jQuery||document.write(\'<script src="'.esc_url(get_template_directory_uri()).'/libs/js/jquery.js"><\/script>\')' );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts' , 'jquery_enqueue_with_fallback' );

function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}

function pagination($pages = '', $range = 4) {
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<ul class=\"pagination center-align\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class=\"active\"><a href=\"\" class=\"inactive\">".$i."</a></li>":"<li class=\"waves-effect\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<li class=\"waves-effect\"><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></lili>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link($pages)."'>Last &raquo;</a><li>";
         echo "</ul>\n";
     }
}

function tieronetwo_next_prev_link()
{
     if (get_next_post() || get_previous_post()) : 
        $prev_post = get_previous_post();
        $next_post = get_next_post();
    ?>
        
    <ul class="page-numbers menu-justified center-align">
        <li class="previous"><a rel="prev" href="<?php echo get_permalink($prev_post->ID) ;?>" class=" ">&laquo; Previous post</a></li>
        <li class="next"><a rel="next" href="<?php echo get_permalink($next_post->ID) ;?>" class=" ">Next post &raquo;</a></li>
    </ul>
    <?php endif;
}

function if_file_exists($image){
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
            )
        )
    );
    $headers = get_headers($image, 1);
    return stristr($headers[0], '200');
}

/**
 * Only use 'hentry' for post types with author and published date
 */
function remove_hentry( $classes, $class, $post_id ) {
    $hentry_post_types = array(
        'page'
    );
 
    $post_type = get_post_type( $post_id );
 
    if ( !in_array( $post_type, $hentry_post_types ) ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
 
    return $classes;
}
add_filter( 'post_class', 'remove_hentry', 10, 3 );