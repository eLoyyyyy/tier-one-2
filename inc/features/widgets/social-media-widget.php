<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

// Creating the widget 
class tonetwo_social_media_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'tonetwo_social_media_widget', 

            // Widget name will appear in UI
            __('[T1.2] Social Media', 'tieronetwo'), 

            // Widget description
            array( 'description' => __( 'Social Media Icons on Tier One.2 Sidebar', 'tieronetwo' ), ) 
        );
    }
    
    
    

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        $facebook = $instance['facebook'];
        $googleplus = $instance['googleplus'];
        $twitter = $instance[ 'twitter' ];
        $youtube = $instance['youtube'];
        $pinterest = $instance['pinterest'];
        $instagram = $instance['instagram'];
        
        
        ?>
        <aside>
            <div class="section">
                <h1 class="h5 center-align" style="font-weight: bold"><?php echo $title;?></h1>
            </div>
            <div class="divider"></div>
            <div class="section">
                <div class="row clearfix center-align">
                    <div class="social-media-icons facebook">
                        <a href="<?php echo $facebook;?>"><i class="fa fa-facebook fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons google-plus">
                        <a href="<?php echo $googleplus;?>"><i class="fa fa-google-plus fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons twitter">
                        <a href="<?php echo $twitter;?>"><i class="fa fa-twitter fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons rss">
                        <a href="<?php bloginfo('rss_url'); ?>"><i class="fa fa-rss fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons youtube">
                        <a href="<?php echo $youtube;?>"><i class="fa fa-youtube fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons pinterest">
                        <a href="<?php echo $pinterest;?>"><i class="fa fa-pinterest fa-3x"></i></a>
                    </div>
                    <div class="social-media-icons instagram">
                        <a href="<?php echo $instagram;?>"><i class="fa fa-instagram fa-3x"></i></a>
                    </div>
                </div>
            </div>
        </aside>
        <div class="divider"></div>
        <?php 

    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['googleplus'] = ( ! empty( $new_instance['googleplus'] ) ) ? strip_tags( $new_instance['googleplus'] ) : '';
        $instance[ 'twitter' ] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
        $instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        return $instance;
    }
    
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title      = $instance[ 'title' ];
            
            $facebook = $instance['facebook'];
            $googleplus = $instance['googleplus'];
            $twitter = $instance[ 'twitter' ];
            $youtube = $instance['youtube'];
            $pinterest = $instance['pinterest'];
            $instagram = $instance['instagram'];

        }
        else {
            $title      = __( 'New title', 'tieronetwo' );
            
            $facebook = __( '', 'tieronetwo' );
            $googleplus = __( '', 'tieronetwo' );
            $twitter = __( '', 'tieronetwo' );
            $youtube = __( '', 'tieronetwo' );
            $pinterest = __( '', 'tieronetwo' );
            $instagram = __( '', 'tieronetwo' );

        }
        
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

         <!--  SOCIAL MEDIA -->  

        <p>
        <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:', '[T1.2] Social Media' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" />
        </p>
<?php 
    }
} 

// Register and load the widget
function tonetwo_social_media_load_widget() {
	register_widget( 'tonetwo_social_media_widget' );
}
add_action( 'widgets_init', 'tonetwo_social_media_load_widget' );