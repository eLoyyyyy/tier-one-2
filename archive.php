<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;
?>

<?php get_header(); ?>

<main class="container" itemscope itemtype="http://schema.org/Blog" style="margin-top: 0px !important">
    <div class="container-navbar">
        <header class="archive-page-header">
            <?php custom_breadcrumbs(); ?>
            <h1 class="archive-page-title">
                <?php echo get_the_archive_title();	?> <?php post_type_archive_title(); ?>
                
            </h1>
        </header>

        <?php
            $term_description = term_description( );
            if (empty($term_description)) :
                printf('<div class="taxonomy-description">%s</div>', $term_description);
            endif;

        ?>
        <div class="row">
            <div class="col l8 m12">
                <?php if ( have_posts() ) : ?>
                
                    
                    <?php while ( have_posts() ) : the_post(); ?>
                

                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            //get_template_part( 'content', get_post_format() );
                        ?>

                        <article class="section" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                            <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                            <header class="entry-meta site-meta-t">
                                <meta itemprop="author" content="<?php the_author();?>">
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
                            <h2 class="h5" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <div class="card medium horizontal">
                                <div class="card-image">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
        
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
                                                <img style="height:401px" class="responsive-img" 
                                         src="<?php the_post_thumbnail_url( 'list' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
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
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:401px" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <div class="card-action white">
                                        <p class="postmetadata">
                                          <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed'); ?> 
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </article>

                        <div class="divider"></div>

                    <?php endwhile; ?>
                    <?php //tierone_paging_nav(); ?>
                </div><!-- .row -->

                <?php else : ?>

                    <?php //get_template_part( 'content', 'none' ); ?>

                <?php endif; wp_reset_query(); ?>
                
            <div class="col l4 m12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>