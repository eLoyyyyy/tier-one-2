<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

setPostViews(get_the_ID());
?>

<?php get_header();?>
<main class="container" style="margin-top: 0px !important">
	<div class="container-navbar">
        <?php if ( have_posts() ) : ?>
            <?php custom_breadcrumbs(); ?>
        
            <?php while ( have_posts() ): the_post(); ?>
                <?php get_template_part('content', 'single'); ?>
            <?php endwhile;?>
        <?php endif; ?>
	</div>
</main>
<?php get_footer();?>