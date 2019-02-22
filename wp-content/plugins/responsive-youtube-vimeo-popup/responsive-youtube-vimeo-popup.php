<?php
/**
 * Plugin Name: WP Video Popup
 * Plugin URI: https://wp-video-popup.com
 * Description: Add beautiful responsive YouTube & Vimeo Video lightbox popups to your WordPress website.
 * Version: 2.2
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 * Text Domain: wp-video-popup
 */

// exit if plugin is accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Plugin constants
define( 'WP_VIDEO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Textdomain
add_action( 'plugins_loaded', 'wp_video_popup_textdomain' );
function wp_video_popup_textdomain() {
	load_plugin_textdomain( 'wp-video-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
}

// Clean up behind us
if( get_option( '_site_transient_disable-ryv-notice' ) ) {
	delete_option( '_site_transient_disable-ryv-notice' );
}

// PAnD
function wp_video_popup_pro_ad() {

	if ( ! PAnD::is_admin_notice_active( 'wp-video-popup-pro-ad-forever' ) ) return;

	?>

	<div data-dismissible="wp-video-popup-pro-ad-forever" class="notice notice-info is-dismissible">
		<p><?php _e( 'WP Video Popup PRO is now available! <strong>Save 30%</strong> and download <a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=admin_notice&utm_campaign=wp_video_popup" target="_blank"><strong>WP Video Popup PRO</strong></a> today.', 'wp-video-popup' ); ?></p>
	</div>

	<?php

}

add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'wp_video_popup_pro_ad' );

// Scripts & Styles
function wp_video_popup_styles() {

	// Enqueue Styles & Scripts
	wp_register_style( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/wp-video-popup.css' );
	wp_enqueue_style( 'wp-video-popup' );

	wp_register_script( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/wp-video-popup.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'wp-video-popup' );

}

add_action( 'wp_enqueue_scripts', 'wp_video_popup_styles' );

// Shortcode
function wp_video_popup_shortcode( $wp_video_popup_atts ) {

	$wp_video_popup_atts = shortcode_atts( array(
		'video' => 'https://www.youtube.com/embed/YlUKcNNmywk',
		'vimeo' => 0,
	), $wp_video_popup_atts, 'wp-video-popup' );

	// vars
	$video = $wp_video_popup_atts['video'];
	$vimeo = $wp_video_popup_atts['vimeo'] ? 1 : 0;

	$video_id = WP_Video_Popup_Parser::get_url_id( $video );

	if( $vimeo ) {
		$video_url = 'https://player.vimeo.com/video/'. $video_id .'?autoplay=1';
	} else {
		$video_url = 'https://www.youtube.com/embed/'. $video_id .'?autoplay=1';
	}

	$video_url = apply_filters( 'wp_video_popup', $video_url );

	$video_attribute = ' data-wp-video-popup-url="'. $video_url .'"';

	// Initialize output
	$wp_video_popup_output = '';

	// Popup Wrapper
	$wp_video_popup_output .= '<div class="wp-video-popup-wrapper">';

	// Close Icon
	$wp_video_popup_output .= '<div class="wp-video-popup-close"></div>';

	// Video
	$wp_video_popup_output .= '<iframe class="wp-video-popup-video" src=""'. $video_attribute .' frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

	// Close Popup Wrapper
	$wp_video_popup_output .= '</div>';

	return $wp_video_popup_output;
}

add_shortcode( 'wp-video-popup', 'wp_video_popup_shortcode' );

/* Required Files */

// PAnD
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'assets/pand/pand.php';

// Backwards Compatibility
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/backwards-compatibility.php';

// Helpers
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/helpers.php';