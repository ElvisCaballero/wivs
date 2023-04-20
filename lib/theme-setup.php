<?php
/**
 * Theme setup
 *
 * @package wivs
 */

namespace Wivs;

/**
 * Theme setup
 */
class ThemeSetup {
	/**
	 * Register hooks
	 */
	public function __construct() {
		$this->createSession();
		add_action( 'after_setup_theme', [ $this, 'theme' ] );
	}

	/**
	 * Create session
	 */
	public function createSession() {
		if ( ! session_id() ) {
			session_start();
		}
	}

	/**
	 * After theme setup
	 */
	public function theme() {
		// Enable plugins to manage the document title
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag.
		add_theme_support( 'title-tag' );

		// Register wp_nav_menu() menus
		// http://codex.wordpress.org/Function_Reference/register_nav_menus.
		register_nav_menus(
			[
				'header' => __( 'Header Navigation' ),
			]
		);

		// Enable post thumbnails
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		// http://codex.wordpress.org/Function_Reference/add_image_size.
		add_theme_support( 'post-thumbnails' );

		// Enable HTML5 markup support
		// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5.
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script' ) );
	}
}

new ThemeSetup();
