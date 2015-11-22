<?php namespace Katana\Helpers;

/**
 * Formatter helper methods to format strings from file names.
 *
 * @package Katana
 * @subpackage helpers
 *
 * @since 1.0.0
 */
class Formatter {
	/**
	 * Helps by creating a more meaningful name on the template by changing
	 * the default page template path for example something like:
	 * page-templates/awesome.php becomes: page_templates_awesome
	 *
	 * @since 1.1.0
	 *
	 * @param string $original The original path of the template.
	 * @return string Formated template name as filter name
	 */
	public static function create_filter_name( $original = '' ) {
		$change = array( '-', '/' );
		$original = str_replace( $change, '_', $original );
		return $this->remove_type( $original );
	}

	/**
	 * Remove the extension type of the file from the string and returns only
	 * the name of the file without the extension
	 *
	 * @since 1.1.0
	 *
	 * @param string $file The file name.
	 * @return string $result The file name without the extension
	 */
	public static function remove_extension( $file ) {
		$has_a_dot = strpos( $file, '.' );
		if ( false === $has_a_dot ) {
			return $file;
		} else {
			return substr( $file, 0, $has_a_dot );
		}
	}
}
