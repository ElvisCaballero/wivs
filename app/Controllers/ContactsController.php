<?php
/**
 * Contacts controller
 *
 * @package wivs
 */

namespace Wivs\Controllers;

/**
 * Contacts controller
 */
class ContactsController {
	/**
	 * View name
	 *
	 * @var string $view The view file to use
	 */
	public $view = 'Contacts';

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
		$i18n = [
			'first_name' => __( 'Name' ),
			'email'      => __( 'Email' ),
			'submit'     => __( 'Submit' ),
		];

		return $i18n;
	}
}
