<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

    <article itemscope itemtype="http://schema.org/BlogPosting">
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
        <div class="collapsible-header active">
            <span class="date-header-mo"><?php echo get_the_time('M', $post->ID); ?></span>
            <span class="date-header-day"><?php echo get_the_time('d', $post->ID); ?></span>
            <span class="title-header truncate clearfix"><span class="left"><?php the_title( sprintf('<h2 class="h6" itemprop="headline" style="font-weight: bold"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );?></span><i class="fa fa-caret-up right" aria-hidden="true"></i></span>
        </div>
        <div class="collapsible-body clearfix" >
            <figure class="left center-align collapsible-image figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                <?php $anchor = get_the_title(); ?>
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
                 src="<?php the_post_thumbnail_url( 'trend4' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>">
                    </a>
                <?php } else { ?>
                <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                <?php
                    $file = wp_get_attachment_image_url( get_attachment_id( get_first_image() ), 'trend5' ); 
                    if (if_file_exists($file)) :
                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                        <meta itemprop="width" content="<?php echo $width; ?>">
                        <meta itemprop="height" content="<?php echo $height; ?>">
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>">
                        <img class="responsive-img" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:201px" itemprop="image" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>"/>
                    </a>
                <?php } ?>
            </figure>
            <div class="right center-align collapsible-content">
                <p class="" itemprop="description"><?php the_excerpt(); ?></p>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="waves-effect waves-light blue-grey darken-4 btn-large">View More</a>
            </div>
        </div>
    </article>