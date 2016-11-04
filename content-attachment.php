<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 
?>



        

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
        <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
        <header class="genpost-entry-header">
            <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                <meta itemprop="url" content="#">
                <meta itemprop="name" content="<?php the_author(); ?>">
            </span>
            <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
            <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
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
                        

                    </figure>
            </div>
        </div>
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="section">
                    <div itemprop="articleBody" class="flow-text"><?php the_content();?></div>
                </div>
                <div class="divider"></div>
                <div class="section">
                    <!-- <p class='resolutions'> Downloads: 
                    <?php
                        /*$images = array();
                        $image_sizes = get_intermediate_image_sizes();
                        array_unshift( $image_sizes, 'full' );
                        foreach( $image_sizes as $image_size ) {
                            $image = wp_get_attachment_image_src( get_the_ID(), $image_size );
                            $name = '' . $image[1] . 'x' . $image[2] . '';
                            $images[] = '<a href="' . $image[0] . '">' . $name . '</a>';
                        }
                        implode( ' | ', $images );*/
                    ?>
                    </p> -->
                </div>
                
                <?php
                    //get_template_part( 'content', 'related' ); //related post
                ?>
                
                <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>
                
                <?php
                    if ( comments_open() || '0' != get_comments_number() )
                         comments_template();              
                ?>
                
                <div id="image-navigation" class="navigation image-navigation">
                    <div class="nav-links">
                    <?php previous_image_link( false, '<div class="previous-image">' . __( 'Previous Image', 'tieronetwo' ) . '</div>' ); ?>
                    <?php next_image_link( false, '<div class="next-image">' . __( 'Next Image', 'tieronetwo' ) . '</div>' ); ?>
                    </div><!-- .nav-links -->
                </div><!-- #image-navigation -->
            </div>
        </div>
</article>

<?php tieronetwo_social_sharing(); ?>
<div class="divider"></div>

        
        