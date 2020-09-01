<?php
/**
 Plugin Name: Hostinza Assistance
 Plugin URI:http://xpeedstudio.com
 Description: Hostinza Assistance is a plugin for our Hostinza Theme.
 Author: xpeedstudio
 Author URI: http://xpeedstudio.com
 Version:1.3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define("XS_PLUGIN_DIR", plugin_dir_path(__FILE__ ));

class Xs_Main{

	/**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     */
    
	public static $_instance;

	/**
     * Plugin Name
     *
     * @since 1.0.0
     *
     */

	public $plugin_name = 'Hostinza Assistance';

	/**
     * Plugin Version
     *
     * @since 1.0.0
     *
     */

	public $plugin_version = '1.0.0';

	/**
     * Plugin File
     *
     * @since 1.0.0
     *
     */

	public $file = __FILE__;

	/**
     * Load Construct
     * 
     * @since 1.0.0
     */

	public function __construct(){
		$this->xs_plugin_init();
	}

	/**
     * Plugin Initialization
     *
     * @since 1.0.0
     *
     */

	public function xs_plugin_init(){

		require_once (plugin_dir_path($this->file). 'post-type/xs-post-class.php');
		require_once (plugin_dir_path($this->file). 'init.php');
        add_action( 'wp_enqueue_scripts', array( $this, 'xs_enqueue_script'));
		
    }
    public function get_social_share(){
        ?>
        <ul class="simple-social-list list-inline">
            <li class="title"><?php esc_html_e('Share :','hostinza');?></li>
            <li><a href="http://www.facebook.com/share.php?u=<?php esc_url(the_permalink());?>title=<?php esc_url(the_title());?>"><i class="fa fa-facebook"></i></a></li>
            <li><a href="http://twitter.com/intent/tweet?status=<?php esc_url(the_title());?>+<?php esc_url(the_permalink());?>"><i class="fa fa-twitter"></i></a></li>
            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink());?>&amp;title=<?php esc_url(the_title());?>&amp;source=<?php echo esc_url(home_url('/'));?>"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php esc_url(the_permalink());?>&amp;is_video=false&amp;description=<?php esc_url(the_title());?>"><i class="fa fa-pinterest-p"></i></a></li>
            <li><a href="https://plus.google.com/share?url=<?php esc_url(the_permalink());?>"><i class="fa fa-google-plus"></i></a></li>
        </ul>
        <?php


    }
    public function xs_enqueue_script(){
        wp_enqueue_script('hostinza-tweetie', HOSTINZA_SCRIPTS . '/tweetie.js',  array( 'jquery' ), '', true );

        $translations_array = array(
            'hostinza_script' => plugin_dir_url($this->file).'api/tweet.php',
        );
        wp_localize_script('hostinza-tweetie', 'hostinza_path', $translations_array);
    }
	public static function xs_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Xs_Main();
        }
        return self::$_instance;
    }

}
$Xs_Main = Xs_Main::xs_get_instance();

