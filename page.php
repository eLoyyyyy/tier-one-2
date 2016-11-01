<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

?>

<?php get_header(); ?>
<main class="container" itemscope="itemscope" itemtype="http://schema.org/Blog">
    <div class="container-navbar">
        <div class="row">
            <div id="primary" class="col l8">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                <?php endwhile; // end of the loop. ?>
            </div>
            <div class="col l4">
                <?php get_sidebar(); ?>
            </div><!-- .bootstrap cols -->
        </div><!-- .bootstrap cols -->
    </div><!-- .row -->
</main>
<?php get_footer(); ?>
