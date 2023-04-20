<?php
/**
 * Home controller
 *
 * @package wivs
 */

namespace Wivs\Controllers;

/**
 * Home controller
 */
class HomeController {
	/**
	 * View name
	 *
	 * @var string $view The view file to use
	 */
	public $view = 'Home';

	/**
	 * Main data for the view
	 */
	public function index() {
		$data = [];

		$data['about'] = [
			'title' => 'About',
			'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
		];

		return $data;
	}

	/**
	 * Translations for the view
	 */
	public function i18n() {
		$i18n = [];

		return $i18n;
	}
}
