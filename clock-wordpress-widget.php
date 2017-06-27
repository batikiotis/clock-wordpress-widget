<?php
/**
 * Plugin Name:   Clock Wordpress Widget Plugin
 * Plugin URI:    https://github.com/batikiotis/clock-wordpress-widget
 * Description:   Display time in your frontend wordpress installation.
 * Version:       1.1
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
    extract( $args );
    $title = get_option( 'widget_title', $instance[ 'title' ] );
    $hour = apply_filters( 'hour', $instance[ 'hour' ] );
    $amorpm = apply_filters( 'amorpm', $instance[ 'amorpm' ] );
    $seperator = apply_filters( 'seperator', $instance[ 'seperator' ] );
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
    ?>
    <p>
        <span class='time-clock-hour'><?php echo date($hour, current_time( 'timestamp', 0 ) ); ?></span>
        <span class='time-clock-seperator'><?php echo $seperator; ?></span>
        <span class='time-clock-min'> <?php echo date('i', current_time( 'timestamp', 0 ) ); ?></span>
        <span class='time-clock-meridiem'><?php echo date($amorpm, current_time( 'timestamp', 0 ) ); ?></span>       
    </p>
    <?php echo $args['after_widget'];
  }
   
  // Create the admin area widget settings form.
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $seperator =!empty( $instance['seperator']) ? $instance['seperator'] : '';
    $hour = !empty( $instance['hour']) ? $instance['hour'] : '';
    $amorpm = !empty( $instance['amorpm'] ) ? $instance['amorpm'] : '';?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'seperator' ); ?>">Seperator:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'seperator' ); ?>" name="<?php echo $this->get_field_name( 'seperator' ); ?>" value="<?php echo esc_attr( $seperator ); ?>" />
    </p>
    <p><label for="<?php echo $this->get_field_id('hour'); ?>">
        <?php _e('12 hour format:'); ?>
        <input id="<?php echo $this->get_field_id('h'); ?>" name="<?php echo $this->get_field_name('hour'); ?>" type="radio" value="h" <?php if($hour === 'h'){ echo 'checked="checked"'; } ?> />
    </label><br>
    <label for="<?php echo $this->get_field_id('hour'); ?>">
        <?php _e('24 hour format:'); ?>
        <input id="<?php echo $this->get_field_id('H'); ?>" name="<?php echo $this->get_field_name('hour'); ?>" type="radio" value="H" <?php if($hour === 'H'){ echo 'checked="checked"'; } ?> />
    </label></p>
    <p><label for="<?php echo $this->get_field_id('amorpm'); ?>">
        <?php _e('Small letters meridiam:'); ?>
        <input id="<?php echo $this->get_field_id('a'); ?>" name="<?php echo $this->get_field_name('amorpm'); ?>" type="radio" value="a" <?php if($amorpm === 'a'){ echo 'checked="checked"'; } ?> />
    </label><br>
    <label for="<?php echo $this->get_field_id('amorpm'); ?>">
        <?php _e('Capital Meridiam:'); ?>
        <input id="<?php echo $this->get_field_id('A'); ?>" name="<?php echo $this->get_field_name('amorpm'); ?>" type="radio" value="A" <?php if($amorpm === 'A'){ echo 'checked="checked"'; } ?> />
    </label></p>   <?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'hour' ] = strip_tags( $new_instance[ 'hour' ] );
    $instance[ 'seperator' ] = strip_tags( $new_instance[ 'seperator' ] );
    $instance[ 'amorpm' ] = strip_tags( $new_instance[ 'amorpm' ] );
    return $instance;
  }
 }
 // Register the widget.
function register_clock_widget() { 
  register_widget( 'clock_widget' );
}
add_action( 'widgets_init', 'register_clock_widget' );
 
 ?>
