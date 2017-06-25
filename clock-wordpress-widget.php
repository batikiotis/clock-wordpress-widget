<?php
/**
 * Plugin Name:   Clock Wordpress Widget Plugin
 * Plugin URI:    https://github.com/batikiotis/clock-wordpress-widget
 * Description:   Display time in your frontend wordpress installation.
 * Version:       1.0
 * Author:        Drivas Theodoros
 * Author URI:    https://www.yria.com.gr
 */
 
 class clock_widget extends WP_Widget {
 
   // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 'classname' => 'clock_widget', 'description' => 'The Wordpress Clock Widget' );
    parent::__construct( 'clock_widget', 'Wordpress Clock Widget', $widget_options );
  }
    // Create the widget output.
  public function widget( $args, $instance ) {
    //$tm_format = get_admin_settings('tm_format');
    $tm_format = apply_filters( 'tm_format', $instance[ 'tm_format' ] );
    $time = current_time( $tm_format, $gmt = 0 );

    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <p><strong>Time:</strong> <?php echo $time ?></p>
   <p><strong>Time format:</strong> <?php echo $tm_format ?></p>

    <?php echo $args['after_widget'];
  }
  
  // Create the admin area widget settings form.
  public function form( $instance ) {
    $tm_format = !empty( $instance['tm_format'] ) ? $instance['tm_format'] : '';?>
    <p>
      <label for="<?php echo $this->get_field_id( 'tm_format' ); ?>">PHP Date Format:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'tm_format' ); ?>" name="<?php echo $this->get_field_name( 'tm_format' ); ?>" value="<?php echo esc_attr( $tm_format ); ?>" />
    
    </p><?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
 }
 // Register the widget.
function register_clock_widget() { 
  register_widget( 'clock_widget' );
}
add_action( 'widgets_init', 'register_clock_widget' );
 
 ?>
