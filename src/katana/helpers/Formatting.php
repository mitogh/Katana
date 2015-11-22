<?php

namespace katana\helpers;

class Formatting {
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
	private function create_filter_name( $original = '' ) {
		$change = array( '-', '/' );
		$original = str_replace( $change, '_', $original );
		return $this->remove_type( $original );
	}

	/**
	 * Remove the .php type of the file from the string and returns only
	 * the name of the file without the extension
	 *
	 * @since 1.1.0
	 *
	 * @param string $file The file name.
	 * @return string $result The file name without the .php extension
	 */
	public static function remove_type( $file ) {
		$pattern = '/\.php/i';
		$matches = preg_split( $pattern, $file );
		$result = '';
		if ( count( $matches ) > 0 ) {
			$result = $matches[0];
		}
		return $result;
	}
}
