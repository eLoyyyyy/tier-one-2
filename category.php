<?php
/**
* A Simple Category Template
*/

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;


get_header(); ?> 

<section class="container">
    <div class="container-navbar">
        <div class="row">
            <div class="col l8 m12">
                <?php 
        
                // Check if there are any posts to display
                if ( have_posts() ) : ?>
                <header class="archive-header">
                    <?php custom_breadcrumbs(); ?>
                    <h1 class="h3 cat-header">Category: <?php single_cat_title(); ?></h1>

                <?php

                // Display optional category description
                if ( category_description() ) : ?>
                    <div class="flow-text cat-description"><?php echo category_description(); ?></div>
                <?php endif; ?>
                </header>

                <div class="divider"></div>
                <?php

                // The Loop
                while ( have_posts() ) : the_post(); ?>

                <article class="section" itemscope itemtype="http://schema.org/BlogPosting">
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
                                        <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:201px" itemprop="image" />
                                    </a>
                                <?php } ?>

                            </figure>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content" itemprop="description">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="card-action">
                                <p class="postmetadata">
                                  <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed'); ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </article>
                
                <div class="divider"></div>

                <?php endwhile; 
                
                global $wp_query;
                pagination($wp_query->max_num_pages);

                else: ?>
                <p>Sorry, no posts matched your criteria.</p>


                <?php endif; ?>
            </div>
            <div class="col l4 m12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>