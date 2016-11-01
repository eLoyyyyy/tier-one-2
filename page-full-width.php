<?php
/*
 * Template Name: Full Width Page Template
 */

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

?>

<?php get_header(); ?>
<main class="container" itemscope itemtype="http://schema.org/Blog">
    <div class="container-navbar">
        <div class="row">
            <div id="primary" class="col l12">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                <?php endwhile; // end of the loop. ?>
            </div>
        </div><!-- .bootstrap cols -->
    </div><!-- .row -->
</main>
<?php get_footer(); ?>
