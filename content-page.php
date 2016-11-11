<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainEntity" itemscope itemtype="http://schema.org/BlogPosting">
	<header class="page-entry-header">
		<?php the_title( '<h1 class="page-entry-title" itemprop="headline">', '</h1>' ); ?>
        <?php 
                global $lang_support;
                $lang = get_theme_mod( 'force_locale', 'en' );
            ?>
            <meta itemprop="inLanguage" content="<?php echo $lang_support['html'][$lang]; ?>">
	</header>
	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>
</article>