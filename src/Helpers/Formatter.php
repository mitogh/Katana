<?php namespace Katana\Helpers;

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

	public static function get_template_name( $template_path ) {
		$tmp = trim( strtolower( $template_path ), ' _-');
		return basename( trim( $tmp, '\s_'), '.php' );
	}
}
