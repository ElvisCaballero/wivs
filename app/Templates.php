<?php
/**
 * Register templates
 *
 * @package wivs
 */

namespace Wivs;

class Templates {
	public function register($page_templates) {
		$templates = [
			'home',
			'contacts',
		];

		foreach ( $templates as $template ) {
			if ( isset( $page_templates[ $template ] ) ) {
				continue;
			}

			$page_templates[ $template ] = str_replace( '-', ' ', ucfirst( $template ) );
		}
		return $page_templates;
	}
}
