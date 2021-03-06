<?php get_header(); ?>
<main class="container" role="main" >
    <div class="container-navbar">
        <div class="row clearfix">
            <div class="col l8 m12">
                <?php 
        
                // Check if there are any posts to display
                if ( have_posts() ) : ?>
                <header class="search-page-header row">
                    <?php custom_breadcrumbs(); ?>
                    <h2 class="h4"><?php printf(__( '<span class="search-title-span">Search Results for: </span> %s', 'tieronetwo' ), '<span>' . get_search_query() . '</span>'); ?></h2>
                </header>
                <?php

                // The Loop
                while ( have_posts() ) : the_post(); ?>

                <article class="section" itemscope itemtype="http://schema.org/BlogPosting">
                    <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                    <header class="genpost-entry-header">
                        <meta itemprop="author" content="<?php the_author();?>">
                        <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
                        <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
                        <meta itemprop="inLanguage" content="<?php echo $lang_support['html'][$lang]; ?>">
                    </header>
                    <h2 class="h5" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="card medium horizontal">
                        <div class="card-image">
                            <figure class="figure center-align" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
        
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
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:401px" itemprop="image" />
                                    </a>
                                <?php } ?>

                            </figure>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content" itemprop="articleBody">
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
            </div><!-- .bootstrap cols -->
            <div class="col l4 m12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>