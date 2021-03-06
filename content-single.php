<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 
?>



        

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainEntity" itemscope itemtype="http://schema.org/BlogPosting">
        <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
        <header class="genpost-entry-header">
            <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                <meta itemprop="url" content="#">
                <meta itemprop="name" content="<?php the_author(); ?>">
            </span>
            <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
            <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
            <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                <?php $logo = get_theme_mod( 'site_logo', '' ); 
                if ( !empty($logo) ) : ?>
                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <meta itemprop="url" content="<?php echo esc_url( $logo ); ?>">
                </span>
                <?php endif; ?>
                <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
            </span>
            <?php 
                global $lang_support;
                $lang = get_theme_mod( 'force_locale', 'en' );
            ?>
            <meta itemprop="inLanguage" content="<?php echo $lang_support['html'][$lang]; ?>">
        </header>
        <?php //tierone_featured_image();
        ?>
        <div class="row">
            <div class="col l12 m12 s12">
                <p class="entry-meta site-meta-t">
                    <?php the_title( '<h2 class="genpost-entry-title" itemprop="headline">', '</h2>' ); ?>
                    Posted by <?php the_author(); ?> on <?php the_time('F j, Y '); ?> in  
                    <?php if ( has_tag() ) : ?>
                        <?php the_tags('',', ',''); ?>
                    <?php endif; ?>
                 </p> 
                
                <figure class="figure center-align" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
        
                        <?php if (has_post_thumbnail() ) { ?>
                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                        <?php
                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                            if (if_file_exists($file)) :
                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                <meta itemprop="width" content="<?php echo $width; ?>">
                                <meta itemprop="height" content="<?php echo $height; ?>">
                            <?php else : ?>
                                <meta itemprop="width" content="">
                                <meta itemprop="height" content="">
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>">
                                <img style="height:400px" class="responsive-img" 
                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                            </a>
                        <?php } else { ?>
                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                        <?php
                            $file = get_first_image(); 
                            if (if_file_exists($file)) :
                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                <meta itemprop="width" content="<?php echo $width; ?>">
                                <meta itemprop="height" content="<?php echo $height; ?>">
                            <?php else : ?>
                                <meta itemprop="width" content="">
                                <meta itemprop="height" content="">
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>">
                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:400px" itemprop="image" />
                            </a>
                        <?php } ?>

                    </figure>
            </div>
        </div>
        <div class="row">
            <div class="col l8 m12 s12">
                <div class="section">
                    <div itemprop="articleBody" class="flow-text"><?php the_content();?></div>
                </div>
                <div class="divider"></div>
                <div class="section">
                    <p>
                    This entry was posted
                    <?php /* This is commented, because it requires a little adjusting sometimes.
                    You'll need to download this plugin, and follow the instructions:
                    http://binarybonsai.com/wordpress/time-since/ */
                    /* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
                    on <?php the_category(', ') ?>.

                    <?php if ( comments_open() && pings_open() ) {
                    // Both Comments and Pings are open ?>
                    You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" >trackback</a> from your own site.

                    <?php } elseif ( !comments_open() && pings_open() ) {
                    // Only Pings are Open ?>
                    Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " >trackback</a> from your own site.

                    <?php } elseif ( comments_open() && !pings_open() ) {
                    // Comments are open, Pings are not ?>
                    You can skip to the end and leave a response. Pinging is currently not allowed.

                    <?php } elseif ( !comments_open() && !pings_open() ) {
                    // Neither Comments, nor Pings are open ?>
                    Both comments and pings are currently closed.

                    <?php } edit_post_link('Edit this entry','','.'); ?>

                    </p>
                </div>
                
                <?php
                    get_template_part( 'content', 'related' ); //related post
                ?>
                
                <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>
                
                <?php
                    if ( comments_open() || '0' != get_comments_number() )
                         comments_template();              
                ?>
                
                <?php tieronetwo_next_prev_link();?> 
            </div>
            <div class="col l4 m12 s12">
                <?php get_sidebar(); ?>
            </div>
        </div>
</article>

<div class="sm-action center-align hide-on-med-and-down">
    <?php echo setPostLike(get_the_ID());?>
    <?php 
    $url = get_the_permalink(); 
    $url = urlencode(esc_url($url));?>
    <a class="facebook btn-large btn" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target='_blank'>
        <i class="fa fa-facebook" aria-hidden="true"></i>
    </a>
    <a class="twitter btn-large btn" target='_blank' href='https://twitter.com/share?url=<?php echo $url; ?>'>
        <i class="fa fa-twitter" aria-hidden="true"></i>
    </a>
    <a class="linkedin btn-large btn" target='_blank' href='http://www.linkedin.com/shareArticle?url=<?php echo $url; ?>'>
        <i class="fa fa-linkedin" aria-hidden="true"></i>
    </a>
    <a class="reddit btn-large btn" target='_blank' href='http://reddit.com/submit?url=<?php echo $url; ?>'>
        <i class="fa fa-reddit-alien" aria-hidden="true"></i>
    </a>
    <a class="google-plus btn-large btn" target='_blank' href='https://plus.google.com/share?url=<?php echo $url; ?>'>
        <i class="fa fa-google-plus" aria-hidden="true"></i>
    </a>
    <?php $image = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0] : get_first_image() ; ?>
    <a class="pinterest btn-large btn" target='_blank' href='http://pinterest.com/pin/create/link/?url=<?php echo $url; ?>&media=<?php echo esc_url( $image ); ?>&description=<?php urlencode(the_title()) ;?>'>
        <i class="fa fa-pinterest" aria-hidden="true"></i>
    </a>
</div>
<div class="divider"></div>

        
        