<?php namespace Katana;

use Katana\Helpers\Config;

/**
 * Katana is a simple filters system to allow user define the only required sizes
 * for the images beein generated from the function `add_image_size`, this will
 * help to decrease the size of the images where sometimes are not required.
 *
 * @package Katana
 * @since 1.0.0
 */
class Edge {

	/**
	 * Constructor that add the two filters one into the native WP filter from
	 * where the images are generated and a custom one to handle images sizes.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( Config::WP_FILTER, [ $this, 'filter' ] );
	}

	/**
	 * WP default filter that runs before the images are being generated, then
	 * appplies the custom filter from Katana.
	 *
	 * @since 1.0.0
	 *
	 * @lik http://codex.wordpress.org/Plugin_API/Filter_Reference/intermediate_image_sizes.html
	 *
	 * @param array $sizes The register sizes of images in WP.
	 * @return array $sizes The array of sizes
	 */
	public function filter( $sizes ) {
		$sizes = apply_filters( Config::KATANA_FILTER, $sizes, $this->request_id() );
		return $sizes;
	}

	/**
	 * Allow access to the current post_id using the $_REQUEST variable
	 *
	 * @since 1.0.0
	 *
	 * @return int An int from 0 to n, that represents the current post id
	 */
	public function request_id() {
		return isset( $_REQUEST['post_id'] ) ?  absint( $_REQUEST['post_id'] ) : 0;
	}
}
