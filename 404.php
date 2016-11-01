<?php get_header(); ?>

<main class="container">
    <section class="container-navbar center-align four-o-four-wrapper">
        <div class="four-o-four" style="background: url('<?php echo get_template_directory_uri() . "/images/error-404-a.png";?>')"></div>
        <p><?php _e('We&#39;re sorry, but the page you&#39;re looking for does not exist.', 'tieronetwo'); ?></p>
        <p>
            <?php 
            printf( 
                __('Return to our <a class="home" href="%s">HOMEPAGE</a>.', 'tieronetwo'),
                home_url(),
                esc_url( wp_get_referer() ) 
                );
            ?>
        </p>
    </section>
</main>

<?php get_footer(); ?>