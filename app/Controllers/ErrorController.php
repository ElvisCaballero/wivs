<?php
/**
 * Error controller
 *
 * @package wivs
 */

namespace Wivs\Controllers;

/**
 * Error controller
 */
class ErrorController {
	/**
	 * View name
	 *
	 * @var string $view The view file to use
	 */
	public $view = 'Error';

	/**
	 * Main data for the view
	 */
	public function index() {
		$data = [];

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
