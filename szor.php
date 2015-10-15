<?php
/**
 * Class to add new sizes of images only where is required to avoid multiple
 * images all over the sites, might be useful to create custom size of
 * imges only on posts, pages or in a custom post type to save disk space.
 *
 * Because native function of wordpress `add_image_size` creates a new size of
 * image for all elements in the page event if are not used.
 *
 * @package Szor
 */

define( 'SZOR_TEXT_DOMAIN', 'SZOR' );

/**
 * Szor class handles all different customization
 */
class Szor {
	/**
	 * Options to create the new size of image.
	 * @var array $options
	 * @since 1.0.0
	 */
	private $options = array();

	/**
	 * Static method to access to this function
	 * @param array $options	The options of the new size.
	 * @since 1.0.0
	 */
	public function __construct( $options ) {
		$this->options = $options;

		$required_params = array( 'name', 'width', 'height' );
		if ( $this->has_set( $required_params ) ) {
			echo('has all');
		} else {
			echo('does not has all');
		}
	}

	/**
	 * Tests if the $options array has all the keys from the $keys array
	 * @param array $keys The array with all of the required params.
	 * @since 1.0.0
	 */
	public function has_set( $keys ) {
		$has_all = false;
		foreach ( $keys as $key ) {
			$has_all = $this->has( $key );
			if ( false === $has_all ) {
				break;
			}
		}
		return $has_all;
	}

	/**
	 * Alias to the array_key_exists function
	 * @param array $key_name The name of the key to search.
	 * @since 1.0.0
	 */
	public function has( $key_name ) {
		return array_key_exists( $key_name, $this->options );
	}
}
