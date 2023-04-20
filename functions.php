<?php
/**
 * Theme functions
 */

/**
 * Load layout controllers
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Init app
 */
function wivs_theme_setup() {
	// Global data
	$global_data = new \Wivs\GlobalData();
	add_action('wp', [ $global_data, 'init' ], 99);

	// Templates
	$templates = new \Wivs\Templates();
	add_filter( 'theme_page_templates', [ $templates, 'register' ], 99 );

	// Ajax
	$ajax = new \Wivs\Ajax();
	add_action( 'rest_api_init', [ $ajax, 'register_routes' ] );
}
wivs_theme_setup();

/**
 * Load theme modifications
 */
function wivs_theme_partials() {
	$partials = [
		'utils',
		'theme-setup',
		'extras',
		'admin',
		'cpts',
		'assets',
		'emoji',
	];
	foreach ( $partials as $partial ) {
		require_once __DIR__ . '/lib/' . $partial . '.php';
	}
}
wivs_theme_partials();

