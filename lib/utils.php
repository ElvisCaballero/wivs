<?php
/**
 * Utility functions
 *
 * @package wivs
 */

/**
 * Get asset url from dist folder
 *
 * @param string $asset_name asset name to get
 */
function asset_url( $asset_name ) {
	$path = get_template_directory_uri() . '/dist/' . $asset_name;
	return $path;
}

/**
 * Image alt
 *
 * @param int $image_id Image id.
 * @return string
 */
function get_image_alt( $image_id = 0 ) {

	$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

	return $image_alt;
}

/**
 * Get image data
 *
 * @param int    $image_id Image id.
 * @param string $size Image size.
 */
function get_image_data( $image_id, $size ) {
	$image = wp_get_attachment_image_src( $image_id, $size );

	$image_data = [
		'src'    => $image[0],
		'width'  => $image[1],
		'height' => $image[2],
		'alt'    => get_image_alt( $image_id ),
	];

	return $image_data;
}
