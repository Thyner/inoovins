<?php class Hostinza_Domain_Checker extends WP_Widget {
	function __construct() {
		parent::__construct(false, $name = __('Hostinza Domain Checker Widget','hostinza'));
	}
	function form($instance) {
			if (isset($instance['title'])) {
				$title = $instance['title'];
				$width = $instance['width'];
				$button = $instance['button'];
				$recaptcha = $instance['recaptcha'];
				$size = $instance['size'];
			}else{
				$title = __("Domain Availability Check","hostinza");
				$width = "";
				$button = "";
				$recaptcha = "no";
				$size = "small";
			}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','hostinza'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:','hostinza'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
		</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button Name:','hostinza'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo $button; ?>" />
		</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('recaptcha'); ?>"><?php _e('reCaptcha:','hostinza'); ?>
			<select id="<?php echo $this->get_field_id( 'recaptcha' ); ?>" name="<?php echo $this->get_field_name( 'recaptcha' ); ?>">
            <option <?php if ( 'no' == $recaptcha ) echo 'selected="selected"'; ?> value="no">Disable</option>
    		<option <?php if ( 'yes' == $recaptcha ) echo 'selected="selected"'; ?> value="yes">Enable</option>
            </select>
		</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:','hostinza'); ?>
			<select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
            <option <?php if ( 'small' == $size ) echo 'selected="selected"'; ?> value="small">Small</option>
    		<option <?php if ( 'large' == $size ) echo 'selected="selected"'; ?> value="large">Large</option>
            </select>
		</label>
		</p>
	<?php
	}
	function update($new_instance, $old_instance) {
	    $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
		$instance['recaptcha'] = ( ! empty( $new_instance['recaptcha'] ) ) ? strip_tags( $new_instance['recaptcha'] ) : '';
		$instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';

		return $instance;
	}

	function widget($args, $instance) {
		$title = $instance['title']; if ($title == '') $title = __('Domain Availability Check','hostinza');
		$width = $instance['width']; if ($width == '') $width = '500';
		$button = $instance['button']; if ($button == '') $button = __('Check','hostinza');
		$recaptcha = $instance['recaptcha']; if ($recaptcha == '') $recaptcha = 'no';
		$size = $instance['size']; if ($size == '') $size = 'small';

		echo $args['before_widget'];

	 	if ( $title ) {
	      echo $args['before_title'] . $title. $args['after_title'];
	   	}

		echo do_shortcode("[hostinzadomainchecker width='$width' button='$button' recaptcha='$recaptcha' size='$size']");

	  	echo $args['after_widget'];
		}
}
