<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Creates widget with recent post thumbnail
 */

class Hostinza_Contact extends WP_Widget
{
    function __construct() {
        $widget_opt = array(
            'classname'     => 'hostinza_widget',
            'description'   => esc_html__('Hostinza Contact','hostinza')
        );
        
        parent::__construct('xs-contacts', esc_html__('Hostinza Contact', 'hostinza'), $widget_opt);
    }
    
    function widget( $args, $instance ){
    	global $wp_query;
        
        echo hostinza_return($args['before_widget']);
        if ( !empty( $instance[ 'title' ] ) ) {

            echo hostinza_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . hostinza_return($args[ 'after_title' ]);
        }

        $address = '';
        $address_one = '';
        $map_url = '';
        $mobile = '';
        $email = '';
        $fax = '';
        $open_time = '';

        if(isset($instance['address'])){
            $address = $instance['address'];
        }
        if(isset($instance['address_one'])){
            $address_one = $instance['address_one'];
        }
        if(isset($instance['map_url'])){
            $address_one = $instance['map_url'];
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }
        if(isset($instance['email'])){
            $email = $instance['email'];
        }
        if(isset($instance['fax'])){
            $fax = $instance['fax'];
        }
        if(isset($instance['open_time'])){
            $open_time = $instance['open_time'];
        }
        $footer_style = hostinza_option( 'footer_style');

        if($footer_style == '1'):
        ?>
        <div class="contact-widget">
            <?php if($address != ''): ?>
                <p><i class="fa fa-map-marker"></i><?php echo esc_html($address); ?></p>
            <?php endif; ?>

            <?php if($address_one != ''): ?>
                <p><i class="fa fa-map-marker"></i><?php echo esc_html($address_one); ?></p>
            <?php endif; ?>

            <?php if($mobile != ''): ?>
                <p><i class="fa fa-mobile"></i><?php echo esc_html($mobile); ?></p>
            <?php endif; ?>

            <?php if($email != ''): ?>
                <p><i class="fa fa-envelope"></i><?php echo esc_html($email); ?></p>
            <?php endif; ?>

            <?php if($fax != ''): ?>
                <p><i class="fa fa-fax"></i><?php echo esc_html($fax); ?></p>
            <?php endif; ?>

            <?php if($open_time != ''): ?>
                <p><i class="fa fa-clock-o"></i><?php echo esc_html($open_time); ?></p>
            <?php endif; ?>

        </div>    
        <?php
        else:
            ?>
            <ul class="contact-info-widget">
                <?php if($address != ''): ?>
                    <li><a href="<?php echo esc_attr($map_url);?>" target="_blank"></i><?php echo esc_html($address); ?></a></li>
                <?php endif; ?>
    
                <?php if($mobile != ''): ?>
                <li><a href="tel:<?php echo esc_attr($mobile); ?>"></i><?php echo esc_html($mobile); ?></a></li>
                <?php endif; ?>
    
                <?php if($email != ''): ?>
                <li><a href="mailto:<?php echo esc_attr($email); ?>"></i><?php echo esc_html($email); ?></a></li>
                <?php endif; ?>
    
                <?php if($fax != ''): ?>
                <li><p></i><?php echo esc_html($fax); ?></p></li>
                <?php endif; ?>
    
                <?php if($open_time != ''): ?>
                <li><p></i><?php echo esc_html($open_time); ?></p></li>
                <?php endif; ?>
    
            </ul>    
            <?php
        endif;
        echo hostinza_return($args['after_widget']);
    }
    
    
    function update ( $old_instance , $new_instance) {
        $new_instance['title'] = strip_tags( $old_instance['title'] );
        $new_instance['address'] = $old_instance['address'];
        $new_instance['address_one'] = $old_instance['address_one'];
        $new_instance['map_url'] = $old_instance['map_url'];
        $new_instance['email'] = $old_instance['email'];
        $new_instance['fax'] = $old_instance['fax'];
        $new_instance['open_time'] = $old_instance['open_time'];
        $new_instance['mobile'] = $old_instance['mobile'];

        return $new_instance;
    	
    }
    
    function form($instance){
    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        else{
            $title = esc_html__( 'Contact', 'hostinza' );
        }

        $address = '';
        $address_one = '';
        $email = '';
        $fax = '';
        $open_time = '';
        $mobile = '';

        if(isset($instance['address'])){
            $address = $instance['address'];
        }
        if(isset($instance['address_one'])){
            $address_one = $instance['address_one'];
        }
        if(isset($instance['map_url'])){
            $address_one = $instance['map_url'];
        }
        if(isset($instance['email'])){
            $email = $instance['email'];
        }
        if(isset($instance['fax'])){
            $fax = $instance['fax'];
        }
        if(isset($instance['open_time'])){
            $open_time = $instance['open_time'];
        }
        if(isset($instance['mobile'])){
            $mobile = $instance['mobile'];
        }

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e( 'Address One:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" type="text" 
                       value="<?php echo esc_attr( $address ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'address_one' )); ?>"><?php esc_html_e( 'Address Two:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address_one' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'address_one' )); ?>" type="text"
                       value="<?php echo esc_attr( $address_one ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'map_url' )); ?>"><?php esc_html_e( 'Map URL:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'map_url' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'map_url' )); ?>" type="text"
                       value="<?php echo esc_attr( $map_url ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>"><?php esc_html_e( 'Mobile:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'mobile' )); ?>" type="text" 
                       value="<?php echo esc_attr( $mobile ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e( 'Email:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="text" 
                       value="<?php echo esc_attr( $email ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'fax' )); ?>"><?php esc_html_e( 'Fax:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'fax' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'fax' )); ?>" type="text" 
                       value="<?php echo esc_attr( $fax ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'open_time' )); ?>"><?php esc_html_e( 'Open Hour:' , 'hostinza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'open_time' )); ?>" 
                       name="<?php echo esc_attr($this->get_field_name( 'open_time' )); ?>" type="text" 
                       value="<?php echo esc_attr( $open_time ); ?>" />
        </p>
        
    <?php
    }
}
