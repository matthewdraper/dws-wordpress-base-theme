<?php
/*
Plugin Name: Draper Web Solutions Slider
Plugin URI: https://github.com/matthewdraper/dws-wordpress-base-theme
Description: This plugin creates a new customizable slider widget.
Author: Draper Web Solutions
Version: 0.0.1
Author URI: https://draperwebsolutions.com
*/

// register My_Widget
add_action( 'widgets_init', function(){
    register_widget( 'Dws_Slide' );
});

function dws_admin_scripts($hook) {

    if( $hook != 'widgets.php' ) {
        return;
    }

    wp_enqueue_script('dws-slider-script', plugins_url('admin/js/dws-slider.js', __FILE__), array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'dws_admin_scripts');

class Dws_Slide extends WP_Widget {
    // class constructor
    public function __construct() {
        $widget_ops = array(
            'classname' => 'dws_slide',
            'description' => 'Draper Web Solutions slide',
        );
        parent::__construct( 'dws_slide', 'DWS Slide', $widget_ops );
    }

    // output the widget content on the front-end
    public function widget( $args, $instance ) {}

    // output the option form field in admin Widgets screen
    // save options
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $rand = (int) $new_instance['the_random_number'];
        $editor_content = $new_instance[ 'wp_editor_' . $rand ];

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $editor_content ) ) ? $editor_content : '';



        $selected_posts = ( ! empty ( $new_instance['selected_posts'] ) ) ? (array) $new_instance['selected_posts'] : array();
        $instance['selected_posts'] = array_map( 'sanitize_text_field', $selected_posts );

        return $instance;


    }

    public function form( $instance )
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( 'text', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'text_domain' ); ?>
            </label>
            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                type="text"
                value="<?php echo esc_attr( $title ); ?>">
        </p>
<!--        <p>-->
<!--            <label for="--><?php //echo $this->get_field_id('image_uri'); ?><!--">Image</label><br />-->
<!--            <input type="text" class="img" name="--><?php //echo $this->get_field_name('image_uri'); ?><!--" id="--><?php //echo $this->get_field_id('image_uri'); ?><!--" value="--><?php //echo $instance['image_uri']; ?><!--" />-->
<!--            <input type="button" class="select-img" value="Select Image" />-->
<!--        </p>-->
        <?php
        /*** add this code ***/
        $rand    = rand( 0, 999 );
        $ed_id   = $this->get_field_id( 'wp_editor_' . $rand );
        $ed_name = $this->get_field_name( 'wp_editor_' . $rand );

        $content   = $text;
        $editor_id = $ed_id;

        $settings = array(
            'media_buttons' => true,
            'textarea_rows' => 3,
            'textarea_name' => $ed_name,
            'teeny'         => true,
        );

        wp_editor( $content, $editor_id, $settings );
        printf(
            '<input type="hidden" id="%s" name="%s" value="%d" />',
            $this->get_field_id( 'the_random_number' ),
            $this->get_field_name( 'the_random_number' ),
            $rand
        );
        /*** end editing ***/
    }
}
