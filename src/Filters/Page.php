<?php namespace Katana\Filters;

use Katana\Helpers\Config;

/**
 * Attach filters specifc to page templates.
 *
 * @since 2.0.0
 */
class Page {

	/**
	 * Constructor that register the filters to associated with the class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_filter( Config::KATANA_FILTER, [ $this, 'filter_by_template_page' ] );
	}

	/**
	 * Filter that allow to change the sizes on pages that uses custom
	 * page templates.
	 *
	 * @since 1.1.0
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $id The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function filter_by_template_page( $sizes, $id = 0 ) {
		$template = get_page_template_slug( $id );
		if ( empty( $template ) ) {
			return $sizes;
		}
		$template_name = Formatter::to_filter_name( $template );
		return apply_filters( Formatter::katana_filter( $template_name ), $sizes );
	}
}
