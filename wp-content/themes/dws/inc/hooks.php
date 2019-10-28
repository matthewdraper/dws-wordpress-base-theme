<?php
/**
 * Custom hooks.
 *
 * @package dws
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'dws_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function dws_site_info() {
		do_action( 'dws_site_info' );
	}
}

if ( ! function_exists( 'dws_add_site_info' ) ) {
	add_action( 'dws_site_info', 'dws_add_site_info' );

	/**
	 * Add site info content.
	 */
	function dws_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'http://wordpress.org/', 'dws' ) ),
			sprintf(
				/* translators:*/
				esc_html__( 'Proudly powered by %s', 'dws' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Theme: %1$s by %2$s.', 'dws' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'http://dws.com', 'dws' ) ) . '">dws.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Version: %1$s', 'dws' ),
				$the_theme->get( 'Version' )
			)
		);

		echo apply_filters( 'dws_site_info_content', $site_info ); // WPCS: XSS ok.
	}
}
