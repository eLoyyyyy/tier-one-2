<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

get_header(); ?>
    <section class="container">
        <h1 class="sr-only">Featured Content</h1>
        <div class="container-navbar">
            <div class="row">
                <?php 
                $args = array(
                    'posts_per_page'  => 5,
                    'orderby' => 'comment_count', 
                    'meta_query' => array(
                        array(
                            'key'     => 'post_views_count',
                                        'orderby' => 'meta_value',
                                        'order' => DESC
                            ,
                        ),
                        array(
                            'key'     => 'votes_count',
                                        'orderby' => 'meta_value_num',
                                        'order' => DESC
                        ),
                    ),
                );
                $query = new WP_Query( $args ); 
                ?>
                <?php if($query->have_posts()) : ?>   
                <div class="col s12 m12 l5">
                    <section class="slider">
                        <h2 class="sr-only">Main Article</h2>
                        <ul class="slides">
                            <?php while( $query->have_posts() ) : $query->the_post(); ?>
                            <li>
                                <?php if ( has_post_thumbnail() ) { ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="overlay blue-green darken-4">
                                                <img class="responsive-img" src="<?php the_post_thumbnail_url( 'front-page-slider' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </div>
                                        </a>
                                <?php } else { ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="overlay blue-green darken-4"><img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image" /></div>
                                        </a>
                                <?php } ?>
                                <div class="caption left-align">
                                    <h3 class="h4"><?php the_title(); ?></h3>
                                </div>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                </div>
                <?php else : ?>
                <div class="col offset-l5 hide-on-med-and-down"></div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                
                <?php 
                
                $args = array(
                    'posts_per_page'  => 3,
                    'offset' => 5,
                    'orderby' => 'comment_count', 
                    'meta_query' => array(
                        array(
                            'key'     => 'post_views_count',
                                        'orderby' => 'meta_value',
                                        'order' => DESC
                            ,
                        ),
                        array(
                            'key'     => 'votes_count',
                                        'orderby' => 'meta_value_num',
                                        'order' => DESC
                        ),
                    ),
                );
                $query = new WP_Query( $args ); 
                ?>
                <?php if($query->have_posts()) : ?> 
                <div class="col l7 m12 s12">
                    <div class="row">
                        <section class="col s12">
                            <div class="divider"></div>
                            <div class="section">
                                <h2 class="h5 center-align" style="font-weight: bold">Trending Topics</h2>
                            </div>
                            <div class="divider"></div>
                            <div class="section">
                                <div class="row">
                                    <?php while( $query->have_posts() ) : $query->the_post(); ?>
                                    <div class="col s4">
                                        <?php get_template_part('inc/tmpl', 'trend'); ?>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php else : ?>
                <div class="col hide-on-large-only hide-on-med-and-down"></div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                
                
            </div>
        </div>
    </section>
    <section class="container margin-top-fix">
        <h1 class="sr-only">Main Content</h1>
        <div class="container-navbar">
            <div class="divider"></div>
            <div class="section row">
                <div class="col l8 m12 s12">
                    <div class="row">
                        <?php $args = array( 'posts_per_page' => 3, ); query_posts($args);?>
                        <?php if(have_posts()) : ?> 
                        <section class="col l4 m4 s12"><!-- -->
                            <div class="section">
                                <h1 class="h5 center-align" style="font-weight: bold">Recent Posts</h1>
                            </div>
                            <div class="divider"></div>
                            <?php while( have_posts() ) : the_post(); ?>
                            <div class="section">
                                <?php get_template_part('inc/tmpl', 'trend2'); ?>
                            </div>
                            <div class="divider"></div>
                            <?php endwhile; ?>
                            <div class="section center-align">
                                <a class="waves-effect waves-light blue-grey darken-4 btn-large">View More</a>
                            </div>
                        </section>
                        <?php else : ?>
                        <div class="col offset-l4 hide-on-med-and-down"></div>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                        <div class="col l8 m8 s12"><!-- -->
                            <?php $categories = get_categories('orderby=count&order=DESC&parent=0'); ?>
                            <?php 
                            
                                $args = array( 'posts_per_page' => 6, 'tag' => 'featured'); 
                                query_posts($args); 
                                $first_part = false;
                            
                            ?>
                            <?php if(have_posts()) : ?> 
                            <section>
                                <div class="section">
                                    <h1 class="h5 center-align" style="font-weight: bold">Featured Articles</h1>
                                </div>
                                <div class="divider"></div>
                                <div class="section"> <!-- -->
                                    <?php while( have_posts() ) : the_post(); ?>
                                        <?php if ( $first_part == false ) : ?>
                                            <?php get_template_part('inc/tmpl', 'trend3a'); ?>
                                            <?php $first_part = true; ?>
                                        <?php else : ?>
                                            <?php get_template_part('inc/tmpl', 'trend3b'); ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                                <div class="section center-align">
                                    <a class="waves-effect waves-light blue-grey darken-4 btn-large">View More</a>
                                </div>
                            </section>
                            <div class="divider"></div>
                            <?php else : ?>
                            <div class="col hide-on-med-and-down"></div>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                            
                            <?php 
                            
                                $args = array('posts_per_page' => 4, 'cat' => $categories[0]->term_id ); 
                                query_posts($args); 
                            
                            ?>
                            <?php if(have_posts()) : ?> 
                            <section>
                                <div class="section">
                                    <h1 class="h5 center-align" style="font-weight: bold"><?php echo get_cat_name($categories[0]->term_id);?></h1>
                                </div>
                                <div class="divider"></div>
                                <div class="section">
                                    <?php while( have_posts() ) : the_post(); ?>
                                        <?php get_template_part('inc/tmpl', 'trend4'); ?>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                            <?php else : ?>
                            <div class="col hide-on-med-and-down"></div>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>

                        </div>    
                    </div>
                    <div class="row">
                        <?php 
                            
                            $args = array('posts_per_page' => 4, 'cat' => $categories[1]->term_id ); 
                            query_posts($args); 

                        ?>
                        <?php if(have_posts()) : ?> 
                        <section class="col s12">
                            <div class="divider"></div>
                            <div class="section">
                                <h1 class="h5 center-align" style="font-weight: bold"><?php echo get_cat_name($categories[1]->term_id);?></h1>
                            </div>
                            <div class="divider"></div>
                            <div class="section">
                                <ul class="collapsible z-depth-0" data-collapsible="accordion">
                                    <?php while( have_posts() ) : the_post(); ?>
                                    <li>
                                        <?php get_template_part('inc/tmpl', 'trend5'); ?>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </section>
                        <?php else : ?>
                        <div class="col hide-on-med-and-down"></div>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
                <section class="col l4 m12 s12">
                    <h1 class="sr-only">Sidebar</h1>
                    <?php get_sidebar(); ?>
                </section>
            </div>
        </div>
    </section>





<?php get_footer(); ?>