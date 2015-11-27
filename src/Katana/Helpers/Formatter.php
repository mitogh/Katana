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
	 * page-templates/awesome.php becomes: page_templates_awesome, always return
	 * and lowercase string.
	 *
	 * @since 1.1.0
	 *
	 * @param string $original The original path of the template.
	 * @return string Formated template name as filter name
	 */
	public static function to_filter_name( $original = '' ) {
		$not_allowed = array( '-', '/', '.' );
		$replace = '_';
		$updated = str_replace( $not_allowed, $replace, $original );
		return strtolower( $updated );
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
		$names = explode( '.', $file );
		return is_array( $names ) && count( $names ) > 0 ? array_shift( $names ) : $file;
	}
}
