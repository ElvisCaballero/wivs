<?php
/**
 * GLobal data
 *
 * @package wivs
 */

namespace Wivs;

use BoxyBird\Inertia\Inertia;

/**
 * Site wide data
 */
class GlobalData {
	/**
	 * Register global data for inertia
	 */
	public function init() {
		Inertia::share( 'i18n', $this->i18n() );
		Inertia::share( 'title', get_the_title() );
		Inertia::share( 'asset_url', asset_url( '' ) );
		Inertia::share( 'ajax_url', home_url( '/wp-json' ) );
		Inertia::share( 'site_name', get_bloginfo( 'name' ) );
		Inertia::share( 'home_url', home_url('/') );

		Inertia::share( 'header', $this->header() );
		Inertia::share( 'footer', $this->footer() );
	}

	/**
	 * Get header menu
	 */
	private function header() {

		$data = [];

		$data['menu'] = $this->getHeaderMenu();

		return $data;
	}

	/**
	 * Get translations
	 */
	private function i18n() {
		$i18n = [
			'socials'       => [
				'facebook'  => 'Facebook',
				'linkedIn'  => 'LinkedIn',
				'instagram' => 'Instagram',
			],
		];

		return $i18n;
	}

	/**
	 * Footer data
	 */
	private function footer() {
		$data = [
			'copy' => date( 'Y' ) . ' ' . __( 'All rights reserved'),
		];

		return $data;
	}

	/**
	 * Get header menu
	 */
	private function getHeaderMenu() {
		// Check if menu exsists
		if ( ! has_nav_menu( 'header' ) ) {
			return [];
		}

		// Get menu id
		$locations = get_nav_menu_locations();
		$menu_id   = $locations['header'] ?? null;

		if ( ! $menu_id ) {
			return [];
		}

		$menu = wp_get_nav_menu_items( $menu_id );

		$data = [];

		foreach ( $menu as $item ) {
			$data[] = [
				'id'   => $item->ID,
				'title' => $item->title,
				'url'   => $item->url,
			];
		}

		return $data;
	}
}
new GlobalData;
