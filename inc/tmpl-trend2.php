<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

    <article class="trending2" itemscope itemtype="http://schema.org/BlogPosting">
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
                    <?php list($width, $height, $type, $attr) = getimagesize($logo);  ?>
                    <meta itemprop="width" content="<?php echo $width; ?>">
                    <meta itemprop="height" content="<?php echo $height; ?>">
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
        <div class="trend-image">
            <?php $categories = get_the_category();
            if ( ! empty( $categories ) ) : ?>
                <p><?php echo esc_html( $categories[0]->name ); ?></p>
            <?php endif; ?>
            
            <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
                <?php $anchor = get_the_title(); ?>
                <?php if (has_post_thumbnail() ) { ?>
                <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                <?php
                    $file = wp_get_attachment_image_url( get_post_thumbnail_id() ); 
                    if (if_file_exists($file)) :
                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                        <meta itemprop="width" content="<?php echo $width; ?>">
                        <meta itemprop="height" content="<?php echo $height; ?>">
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>">
                        <img class="responsive-img" 
                 src="<?php the_post_thumbnail_url( 'trend2' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>">
                    </a>
                <?php } else { ?>
                <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                <?php
                    $file = wp_get_attachment_image_url( get_attachment_id( get_first_image() ), 'trend2' ); 
                    if (if_file_exists($file)) :
                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                        <meta itemprop="width" content="<?php echo $width; ?>">
                        <meta itemprop="height" content="<?php echo $height; ?>">
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>">
                        <!-- <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:305px" itemprop="image" /> -->
                        
                        <img class="responsive-img" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:305px" itemprop="image" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>" />
                    </a>
                <?php } ?>

            </figure>
        </div>
        <div class="trend-content">
            <time><?php the_time('F j, Y'); ?></time>
            <h2 class="h6 clamp clamp-four" itemprop="headline" style="font-weight: bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="clamp clamp-six" itemprop="description"><?php the_excerpt(); ?></p>
        </div>
    </article>