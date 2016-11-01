<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

// Creating the widget 
class tonetwo_archive_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'tonetwo_archive_widget', 

            // Widget name will appear in UI
            __('[T1.2] Custom Archive Widget', 'tieronetwo'), 
            
            // Widget description
            array( 'description' => __( 'Custom Archive Widget for Tier One.2', 'tieronetwo' ), 
                    'classname'   => 'tonetwo_archive_widget',) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = null; $before_widget = null; $after_widget = null; 
        
        if (! empty( $instance['title'] ) ) { $title = apply_filters('widget_title', $instance['title'] ); }
        if (! empty( $args['before_widget'] ) ) { $before_widget = $args['before_widget']; }
        if (! empty( $args['after_widget'] ) ) { $after_widget = $args['after_widget']; }
                
        ?>
        <aside>
            <div class="section">
                <?php if ( ! empty( $title ) ) : ?>
                <h1 class="h5 center-align" style="font-weight: bold"><?php echo $instance['title']; ?></h1>
                <?php endif; ?>
            </div>
            <div class="divider"></div>
            <div class="section">
                <ul class="archive">
                    <?php $args = array(
                        'type'            => 'monthly',
                        'limit'           => '',
                        'format'          => 'html', 
                        'before'          => '',
                        'after'           => '',
                        'show_post_count' => false,
                        'echo'            => 1,
                        'order'           => 'DESC',
                            'post_type'     => 'post'
                    );
                    wp_get_archives( $args ); ?>
                </ul>
            </div>
        </aside>
        <div class="divider"></div>

        <?php
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
} // Class wpb_widget ends here

// Register and load the widget
function tonetwo_archive_load_widget() {
	register_widget( 'tonetwo_archive_widget' );
}
add_action( 'widgets_init', 'tonetwo_archive_load_widget' );

function archive_list_item_filter( $link_html ) {
    $link_html = preg_replace('/<li>/i', '<li class="archive-item">', $link_html );
    return $link_html;
}

add_filter( 'get_archives_link', 'archive_list_item_filter' );