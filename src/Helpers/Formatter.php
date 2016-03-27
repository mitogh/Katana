<?php namespace Katana\Helpers;

use Katana\Helpers\Config;

/**
 * Formatter helper methods to format strings from file names.
 *
 * @package Katana
 * @subpackage helpers
 *
 * @since 2.0.0
 */
class Formatter {
	/**
	 * Helps by creating a more meaningful name on the template by changing
	 * the default page template path for example something like:
	 * page-templates/awesome.php becomes: page_templates_awesome, always return
	 * and lowercase string.
	 *
	 * @since 1.1.0
	 *
	 * @param string $original The original path of the template.
	 * @return string Formated template name as filter name
	 */
	public static function to_filter_format( $original = '' ) {
		$to_be_replaced = array( '-', '/', '.' );
		$to_replace = '_';
		$original = self::get_template_name( $original );
		return strtolower( str_replace( $to_be_replaced, $to_replace, $original ) );
	}

	/**
	 * Creates a specific katana filter based on a param, like a post_id,
	 * a page template name or similar.
	 *
	 * @param string $param The suffix of the filter
	 * @return string KATANA_FILTER by default and adding a suffix is param is provided.
	 * @since 2.0.0
	 */
	public static function katana_filter( $param = '' ) {
		if ( $param ) {
			$param = trim($param, ' _');
			return sprintf( '%s_%s', Config::KATANA_FILTER, $param );
		} else {
			return Config::KATANA_FILTER;
		}
	}

	/**
	 * Helper function that returns the name of the template regardless of the location
	 * of the template for instance something like:
	 *
	 * Example page-templates/contact-page.php => contact-page
	 *
	 * To have shorter filter names.
	 *
	 * @param string $template_path The path to the template.
	 * @return string See example above.
	 */
	public static function get_template_name( $template_path ) {
		$tmp = trim( strtolower( $template_path ), ' _-' );
		return basename( $tmp, '.php' );
	}
}
