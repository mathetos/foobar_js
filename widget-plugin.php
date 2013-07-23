<?php
/*
Plugin Name: Put Javascript in FooBar
Plugin URI: mattcromwell.com
Description: A simple plugin that allows you to put advanced Javascripts in your FooBar message
Version: 1.0
Author: Matt Cromwell
Author URI: http://mattcromwell.com
License: GPL
*/

class foobar_js extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function foobar_js() {
        parent::WP_Widget(false, $name = 'Put JS in FooBar');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    public function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $textarea = $instance['textarea'];
		$before_widget .= '<div id="js4foobar" style="display:none">';
		$after_widget = '</div>' . $after_widget;

		echo $before_widget;
		$output = do_shortcode($textarea);
		echo $output;
		echo $after_widget;
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textarea'] = strip_tags($new_instance['textarea']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
        $textarea = esc_attr($instance['textarea']);

        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
        <label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('This is a textarea:'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
    </p>

        <?php 
    }
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("foobar_js");'));

?>