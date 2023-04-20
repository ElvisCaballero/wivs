<?php
/**
 * Custom post types
 *
 * @package wivs
 */

namespace Wivs;

use WP_Error;

/**
 * Register CPT's
 */
function register_cpts() {
	$post_types = [
		'portfolio',
	];

	foreach ( $post_types as $post_type ) :
		$partial = $post_type . '/' . $post_type . '.php';
		require_once $partial;
	endforeach;
}
register_cpts();

/**
 * Register single custom post type
 *
 * @param array $args Function args.
 * @param array $reg_args Args for register_post_type function.
 */
function register_cpt( $args, $reg_args ) {
	$cpt = wp_parse_args(
		$args,
		[
			'post_type'       => '',
			'admin_menu_icon' => '',
			'singular_title'  => '',
			'plural_title'    => '',
		]
	);

	if ( ! $cpt['post_type'] ) {
		new WP_Error( '', 'No post_type specified' );
		die;
	}

	$labels = [
		'name'               => $cpt['plural_title'],
		'singular_name'      => $cpt['singular_title'],
		'edit_item'          => 'Edit ' . $cpt['singular_title'],
		'menu_name'          => $cpt['singular_title'],
		'name_admin_bar'     => $cpt['singular_title'],
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New ' . $cpt['singular_title'],
		'new_item'           => 'New ' . $cpt['singular_title'],
		'edit_item'          => 'Edit ' . $cpt['singular_title'],
		'view_item'          => 'View ' . $cpt['singular_title'],
		'all_items'          => 'All ' . $cpt['plural_title'],
		'search_items'       => 'Search ' . $cpt['plural_title'],
		'parent_item_colon'  => 'Parent :' . $cpt['singular_title'],
		'not_found'          => 'No ' . $cpt['singular_title'] . ' found.',
		'not_found_in_trash' => 'No ' . $cpt['singular_title'] . ' found in Trash.',
	];

	$args = wp_parse_args(
		$reg_args,
		[
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'capabilities'       => [],
			'map_meta_cap'       => true,
			'hierarchical'       => true,
			'has_archive'        => false,
			'menu_position'      => 30,
			'menu_icon'          => '',
			'supports'           => [ 'title', 'thumbnail', 'editor' ],
			'rewrite'            => [
				'slug' => 'slug_' . $cpt['post_type'],
			],
		]
	);

	register_post_type( $cpt['post_type'], $args );
}
