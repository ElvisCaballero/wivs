<?php
/**
 * Ajax controller
 */

namespace Wivs;

/**
 * Create Ajax
 */
class Ajax {
	/**
	 * Namespace
	 *
	 * @var string $namespace The namespace.
	 */
	public static $namespace = 'wivs';

	/**
	 * Register rest routes
	 */
	public function register_routes() {
		register_rest_route(
			self::$namespace,
			'/contacts',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'handle_contact_form' ],
				'permission_callback' => '__return_true',
			]
		);
	}

	/**
	 * Handle form
	 *
	 * @param \WP_REST_Request $request The request.
	 */
	public function handle_contact_form( \WP_REST_Request $request ) {
		$data = $request->get_params();

		// Validate the data.
		$rules = [
			'email' => [ 'required', 'email' ],
		];

		$v = new \Valitron\Validator( $data );
		$v->mapFieldsRules( $rules );

		// If validation fails, store errors in session and redirect back to the previous page.
		if ( ! $v->validate() ) {
			$_SESSION['errors'] = $v->errors();

			wp_redirect( wp_get_referer() );
			exit;
		}

		// ! Store form etc.

		// Redirect back.
		wp_redirect( wp_get_referer() );
		exit;
	}
}

new Ajax();
