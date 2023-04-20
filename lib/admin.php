<?php
/**
 * Admin stuff
 *
 * @package wivs
 */

namespace Wivs;

use Yoast\WP\SEO\Context\Meta_Tags_Context;

/**
 * Disable gutenburg
 */
add_filter( 'use_block_editor_for_post', '__return_false' );

/**
 * Disable content editor on pages
 */
add_action(
	'admin_init',
	function () {
		remove_post_type_support( 'page', 'editor' );
	}
);

/**
 * Disable admin bar
 */
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Add FAQPage schema
 *
 * @param array             $data    Schema.org graph.
 * @param Meta_Tags_Context $context Context object.
 */
add_filter(
	'wpseo_schema_graph',
	function( $data, $context ) {
		if ( empty( $context->indexable->object_id ) ) {
			return $data;
		}

		$object_id = $context->indexable->object_id;

		$enable = get_field( 'enable_faq_block', $object_id );

		if ( ! $enable ) {
			return $data;
		}

		$faq = get_field( 'faq', $object_id );

		if ( empty( $faq ) ) {
			return $data;
		}

		$data[] = [
			'@type'      => 'FAQPage',
			'isPartOf'   => [
				'@id' => $context->indexable->permalink,
			],
			'mainEntity' => array_map(
				function( $item ) {
					return [
						'@type'          => 'Question',
						'name'           => $item['question'],
						'acceptedAnswer' => [
							'@type' => 'Answer',
							'text'  => $item['answer'],
						],
					];
				},
				$faq
			),
		];

		return $data;
	},
	10,
	2
);
