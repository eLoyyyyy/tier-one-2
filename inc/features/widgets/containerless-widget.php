<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

class Tier_One_Two_Widget extends WP_Widget{
    
    function __construct() {
        parent::__construct(
            'Tier_One_Two_Widget',
            __('[T1.2] Meta Widget', 'tieronetwo'),
            array( 'description' => __('Insert header tags without using the editor!', 'tieronetwo'), )
        );
    }
    
    public function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        /*if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } */?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
        <?php
        echo $after_widget;
    }
    
    public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<?php
	}
    
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['filter'] = ! empty( $new_instance['filter'] );
		return $instance;
	}
    
    
}

add_action( 'widgets_init', function(){
    register_widget( 'Tier_One_Two_Widget' );
});