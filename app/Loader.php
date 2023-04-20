<?php
/**
 * Loader
 *
 * @package wivs
 */

namespace Wivs;

use BoxyBird\Inertia\Inertia;

/**
 * Controller loader
 */
class Loader {
	/**
	 * Render view
	 */
	public static function render() {
		$template = self::get_template();
		$class    = self::get_class( $template );
		$object   = new $class();

		// Add errors to data for inertia forms.
		$errors = $_SESSION['errors'] ?? null;
		unset( $_SESSION['errors'] );
		if ( $errors ) {
			Inertia::share( 'errors', fn () => $errors );
		}

		// Share page translations.
		Inertia::share( 'i18n.page', $object->i18n() );

		// Return view.
		return Inertia::render( $object->view, $object->index() );
	}

	/**
	 * Get class from template
	 *
	 * @param string $template The template name.
	 */
	private static function get_class( $template ) {
		$template = str_replace( '-', ' ', $template );
		$template = str_replace( ' ', '', ucwords( $template ) );

		return "Wivs\\Controllers\\{$template}Controller";
	}

	/**
	 * Get template
	 */
	private static function get_template() {
		$template = 'Default';

		$p_template = get_page_template_slug();

		switch ( true ) {
			case is_404():
				$template = 'Error';
				break;
			case is_page() && $p_template:
				$template = $p_template;
				break;
			case is_singular() && ! is_page():
				$template = 'single-' . get_post_type();
				break;
		}

		return $template;
	}
}
