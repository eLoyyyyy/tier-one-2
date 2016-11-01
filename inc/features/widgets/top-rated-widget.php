<?php

// Creating the widget 
class tonetwo_top_rated_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'tonetwo_top_rated_widget', 

            // Widget name will appear in UI
            __('[T1.2] Top Rated Posts', 'tieronetwo'), 

            // Widget description
            array( 'description' => __( 'Top Rated Posts on Tier One.2', 'tieronetwo' ), ) 
        );
    }
    
    
    

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        $args = array(
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        );
        $query = new WP_Query( $args ); 
        // 'meta_key=votes_count&orderby=meta_value_num&order=DESC&posts_per_page=10'
        // 'meta_key=post_views_count&orderby=meta_value&order=DESC&posts_per_page=10'
        // print_r($query);
        ?>
        <aside>
            <div class="section">
                <h1 class="h5 center-align" style="font-weight: bold"><?php echo $args['before_title'] . $title . $args['after_title'] ;?></h1>
            </div>
            <div class="divider"></div>
        <?php if ( $query->have_posts() ) : ?>
        
            <div class="section">
            <?php while( $query->have_posts() ) : $query->the_post(); ?>

                <div class="top-rates clearfix">
                    <div class="tr-image">
                        <!-- <img class="responsive-img" src="http://placehold.it/143x86"/> -->
                        <?php if (has_post_thumbnail() ) { ?>
                            <a href="<?php the_permalink(); ?>">
                                <img style="height:86px" class="responsive-img" 
                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                            </a>
                        <?php } else { ?>
                            <a href="<?php the_permalink(); ?>">
                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:86px" itemprop="image" />
                            </a>
                        <?php } ?>
                    </div>
                    <div class="tr-content">
                        <h2 class="h6 clamp clamp-two" style="font-weight: bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="row clearfix">
                            <div class="col offset-s2 s10"><i class="fa fa-eye"></i>&nbsp<?php echo getPostViews(get_the_ID());?></div>
                        </div>
                    </div>
                </div>
                
            <?php endwhile; ?>
            </div>
        </aside>
        <div class="divider"></div>
        <?php endif; ?>

        <?php
        wp_reset_query();

        // This is where you run the code and display the output
        echo __( $rp, 'wpb_widget_domain' );
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'tieronetwo' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} 

// Register and load the widget
function tonetwo_top_rated_load_widget() {
	register_widget( 'tonetwo_top_rated_widget' );
}
add_action( 'widgets_init', 'tonetwo_top_rated_load_widget' );