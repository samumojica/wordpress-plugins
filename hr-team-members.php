<?php
/*
Plugin Name: HR Sidebar
Description: Plugin for display a team member or HR member 
Version: 0.0.2
Author: Samuel Mojica
*/

	 
class wp_my_plugin extends WP_Widget {

	// constructor
	function wp_my_plugin() {
		parent::WP_Widget( false, $name = __( 'HR Department', 'wp_widget_plugin' ) );
	}

	// widget form creation
	function form( $instance ) {

		// Check values
		if ( $instance ) {
			$image = esc_attr( $instance[ 'image' ] );
			$title = esc_attr( $instance[ 'title' ] );
			$email = esc_attr( $instance[ 'email' ] );
			$text = esc_attr( $instance[ 'text' ] );
			$textarea = esc_textarea( $instance[ 'textarea' ] );
		} else {
			$image = '';
			$title = '';
			$email = '';
			$text = '';
			$textarea = '';
		}


		?>

		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>">
				<?php _e('Image Profile Link', 'wp_widget_plugin'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Name', 'wp_widget_plugin'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">
				<?php _e('Email', 'wp_widget_plugin'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="email" value="<?php echo $email; ?>"/>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>">
				<?php _e('Position inside the HR department', 'wp_widget_plugin'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>"/>
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>">
				<?php _e('A brief bio', 'wp_widget_plugin'); ?>
			</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>">
				<?php echo $textarea; ?>
			</textarea>
		</p>
		<?php
	}



	// update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// Fields
		$instance[ 'image' ] = strip_tags( $new_instance[ 'image' ] );
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'email' ] = strip_tags( $new_instance[ 'email' ] );
		$instance[ 'text' ] = strip_tags( $new_instance[ 'text' ] );
		$instance[ 'textarea' ] = strip_tags( $new_instance[ 'textarea' ] );
		return $instance;
	}

	
	
	// display widget
	function widget( $args, $instance ) {
		extract( $args );
		// these are the widget options
		$image = $instance[ 'image' ];
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$email = $instance[ 'email' ];
		$text = $instance[ 'text' ];
		$textarea = $instance[ 'textarea' ];
		

		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';


		// Check if title is set
		if ( $image ) {
			echo '<img src="' . $image . '" class="hr-profile-pic">';
		}

		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		
		// Check if text is set
		if ( $email ) {
			echo '<div class="wp-sam-widget-icon tooltiper"><a href="mailto:' . $email . '"><img src="text.png" /></a><span class="tooltiptext">' . $email . '</span></div>';
		}

		// Check if text is set
		if ( $text ) {
			echo '<p class="wp_widget_plugin_text-hr">' . $text . '</p>';
		}
		// Check if textarea is set
		if ( $textarea ) {
			echo '<p class="wp_widget_plugin_textarea">' . $textarea . '</p>';
		}
		echo '</div>';
		echo $after_widget;
	}
}



// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget("wp_my_plugin");' ) );









?>
