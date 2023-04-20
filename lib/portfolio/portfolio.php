<?php
/**
 * Register Portfolio CPT
 *
 * @package wivs
 */

namespace Wivs;

add_action(
	'init',
	function () {
		$args = [
			'post_type'      => 'portfolio',
			'singular_title' => 'Portfolio',
			'plural_title'   => 'Portfolios',
		];

		$cpt_args = [
			'menu_icon' => 'dashicons-portfolio',
			'supports'  => [ 'title' ],
		];

		register_cpt( $args, $cpt_args );

		// Category labels.
		$plural_title   = 'Portfolio Categories';
		$singular_title = 'Portfolio Category';
		$singular 	    = 'portfolio';
		$labels = array(
			'name'          => $plural_title,
			'singular_name' => $singular_title,
			'add_new_item'  => 'Add new ' . $singular_title,
			'new_item_name' => 'New ' . $singular_title . ' name',
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'hierarchical'       => true,
			'show_ui'            => true,
			'publicly_queryable' => true,
		);
		register_taxonomy( $singular . '_category', array( $singular ), $args );
	}
);


/**
 * Partials
 */
function wivs_portfolio_partials() {
	$partials = array(
		// 'fields',
	);
	foreach ( $partials as $partial ) :
		$partial = 'portfolio-' . $partial . '.php';
		require_once $partial;
	endforeach;
}
wivs_portfolio_partials();
