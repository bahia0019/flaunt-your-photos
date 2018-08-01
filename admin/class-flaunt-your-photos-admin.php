<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://flauntyoursite.com
 * @since      1.0.0
 *
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/admin
 * @author     William Bay <william@flauntyoursite.com>
 */
class Flaunt_Your_Photos_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'SwiperStyles', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flaunt-your-photos-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( 'FYP React', plugin_dir_url( __FILE__ ) . 'fyp-react/src/index.js', array(), '2018-4-01', false );
		// wp_enqueue_script( 'FYP React App', plugin_dir_url( __FILE__ ) . 'fyp-react/src/App.js', array(), '2018-4-01', true );
		
		// wp_enqueue_script( 'TweenLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenLite.min.js', array(), '2018-4-01', true );
		wp_enqueue_script( 'TimelineMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TimelineMax.min.js', array(), '2018-4-01', true );
		wp_enqueue_script( 'GreensockCSSPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/plugins/CSSPlugin.min.js', array(), '2018-4-01', true );
		wp_enqueue_script( 'Swiper Slider', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js', array(), '2018-4-01', false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flaunt-your-photos-admin.js', array( 'jquery' ), $this->version, true );

		wp_localize_script( $this->plugin_name, 'fyp_site_get_url', array( 'currentSite' => get_bloginfo( 'url' ) ) );
	}

}


// Add Btn after 'Media'
function fyp_media_button() {
	echo '<a href="#" id="insert-my-media" class="button">Add my media</a>';
}

add_action( 'media_buttons', 'fyp_media_button', 15);


// Loads modal into footer.
function fyp_load_modal() {
	require_once('fyp-react/public/fyp-react-modal.php');
	// require_once('partials/flaunt-your-photos-admin-modal.php');
}
add_action( 'admin_footer-post-new.php', 'fyp_load_modal' );
add_action( 'admin_footer-post.php', 'fyp_load_modal' );



// Inserts new tab to wp.media
function my_media_menu( $tabs ) {
	$newtab = array( 'my_custom_tab' => __('My Tab') );
	return array_merge($tabs, $newtab);
}

add_filter( 'media_upload_tabs', 'my_media_menu' );



