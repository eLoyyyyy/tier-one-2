<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>


        <div class="collapsible-header active">
            <span class="date-header-mo"><?php echo get_the_time('M', $post->ID); ?></span>
            <span class="date-header-day"><?php echo get_the_time('d', $post->ID); ?></span>
            <span class="title-header truncate clearfix"><span class="left"><?php the_title( sprintf('<h2 class="h6" itemprop="headline" style="font-weight: bold"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );?></span><i class="fa fa-caret-up right" aria-hidden="true"></i></span>
        </div>
        <article class="collapsible-body clearfix" itemscope itemtype="http://schema.org/BlogPosting">
            <figure class="left center-align collapsible-image figure">
                <?php if (has_post_thumbnail() ) { ?>
                <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                <?php
                    list($width, $height, $type, $attr) = getimagesize(wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())));            
                ?>
                <meta itemprop="width" content="<?php echo $width; ?>">
                <meta itemprop="height" content="<?php echo $height; ?>">
                    <a href="<?php the_permalink(); ?>">
                        <img style="height:145px" class="responsive-img" 
                 src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                    </a>
                <?php } else { ?>
                <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                <?php
                    list($width, $height, $type, $attr) = getimagesize(get_first_image());          
                ?>
                <meta itemprop="width" content="<?php echo $width; ?>">
                <meta itemprop="height" content="<?php echo $height; ?>">
                    <a href="<?php the_permalink(); ?>">
                        <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:145px" itemprop="image" />
                    </a>
                <?php } ?>
            </figure>
            <div class="right center-align collapsible-content">
                <p class="" itemprop="description"><?php the_excerpt(); ?></p>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="waves-effect waves-light blue-grey darken-4 btn-large">View More</a>
            </div>
        </article>

            
            