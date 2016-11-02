<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

    <article class="trending" itemscope itemtype="http://schema.org/BlogPosting">
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
        <div class="trend-image">
            <?php $categories = get_the_category();
            if ( ! empty( $categories ) ) : ?>
                <p><?php echo esc_html( $categories[0]->name ); ?></p>
            <?php endif; ?>
            
            <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
        
                    <?php if (has_post_thumbnail() ) { ?>
                    <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                    <?php
                        $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                        if (if_file_exists($file)) :
                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                            <meta itemprop="width" content="<?php echo $width; ?>">
                            <meta itemprop="height" content="<?php echo $height; ?>">
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>">
                            <img class="responsive-img" 
                     src="<?php the_post_thumbnail_url( 'trend3a' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                        </a>
                    <?php } else { ?>
                    <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                    <?php
                        $file = get_first_image(); 
                        if (if_file_exists($file)) :
                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                            <meta itemprop="width" content="<?php echo $width; ?>">
                            <meta itemprop="height" content="<?php echo $height; ?>">
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>">
                            <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:306px" itemprop="image" />
                        </a>
                    <?php } ?>

                </figure>
            
            <div class="trend-caption">
                <time><?php the_time('F j, Y'); ?></time>
                <?php the_title( sprintf('<h2 class="h6 truncate" itemprop="headline" style="font-weight: bold"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );?>
            </div>
        </div>
        <div class="trend-content">
            <p class="clamp clamp-six" itemprop="description"><?php the_excerpt(); ?></p>
        </div>
    </article>