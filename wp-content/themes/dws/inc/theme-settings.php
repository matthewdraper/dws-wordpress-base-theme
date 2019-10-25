<?php
/**
 * Check and setup theme's default settings
 *
 * @package dws
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'dws_setup_theme_default_settings' ) ) {
	function dws_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$dws_posts_index_style = get_theme_mod( 'dws_posts_index_style' );
		if ( '' == $dws_posts_index_style ) {
			set_theme_mod( 'dws_posts_index_style', 'default' );
		}

		// Sidebar position.
		$dws_sidebar_position = get_theme_mod( 'dws_sidebar_position' );
		if ( '' == $dws_sidebar_position ) {
			set_theme_mod( 'dws_sidebar_position', 'right' );
		}

		// Container width.
		$dws_container_type = get_theme_mod( 'dws_container_type' );
		if ( '' == $dws_container_type ) {
			set_theme_mod( 'dws_container_type', 'container' );
		}
	}
}
