<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<header class="page-entry-header" itemprop="headline">
		<?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>
</article>