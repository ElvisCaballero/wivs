<?php
/**
 * Theme assets
 *
 * @package wivs
 */

namespace Wivs;

use BoxyBird\Inertia\Inertia;

// Remove unused head options.
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );

/**
 * Admin assets
 */
function admin_assets() {
	$manifest = get_asset_manifest();

	// Admin styles.
	$css = $manifest['src/styles/admin-style.scss'];
	wp_enqueue_style( 'wivs-admin', asset_url( $css['file'] ), [], null );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\admin_assets', 100 );

/**
 * Remove unused scripts and styles
 */
function remove_unused_assets() {
	// Classic theme.
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
	// Block library.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );

	wp_dequeue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\remove_unused_assets', 100 );

/**
 * Return manifest file
 */
function get_asset_manifest() {
	$manifest_file = get_template_directory() . '/dist/manifest.json';

	if ( ! file_exists( $manifest_file ) ) {
		return [];
	}

	$manifest = file_get_contents( $manifest_file );
	$manifest = json_decode( $manifest, true );

	return $manifest;
}

/**
 * Add inertia frontend
 */
function load_assets() {
	$hot_file = get_template_directory() . '/public/hot';

	$dev = file_exists( $hot_file );

	if ( $dev ) {
		$hot = file_get_contents($hot_file );

		wp_enqueue_script( 'hot-vite', $hot.'/@vite/client', [], null, true );
		wp_enqueue_script( 'hot-main', $hot.'/src/js/app.js', [], null, true );
	} else {
		$manifest = get_asset_manifest();

		// Svelte JS.
		$js = $manifest['src/js/app.js'];
		wp_enqueue_script( 'wivs-app', asset_url( $js['file'] ), [], null, true );

		// Svelte styling.
		$css = $manifest['src/js/app.css'];
		wp_enqueue_style( 'wivs-page', asset_url( $css['file'] ), [], null );
	}

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\load_assets' );

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( ! in_array($handle, ['hot-vite', 'hot-main'] ) ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}
add_filter('script_loader_tag', __NAMESPACE__ . '\\add_type_attribute' , 10, 3);

/**
 * Add Inertia version. Helps with cache busting
 */
function version_inertia() {
	$manifest_file = get_template_directory() . '/dist/manifest.json';

	if ( ! $manifest_file ) {
		return;
	}

	$version = md5_file( $manifest_file );

	Inertia::version( $version );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\version_inertia' );
