<?php
/**
 * Katana filters
 * @package Katana
 */

/**
 * Wordpress filter that runs before the sizes of images are generated
 * @since 1.0.0
 */
define( 'KATANA_WP_FILTER', 'intermediate_image_sizes' );

/**
 * Prefix of all of the Katana filters
 * @since 1.0.0
 */
define( 'KATANA_FILTER', 'katana_refine' );

/**
 * Katana is a simple filters system to allow user define the only required sizes
 * for the images beein generated from the function `add_image_size`, this will
 * help to decrease the size of the images where sometimes are not required.
 * @package Katana
 */
class Katana {
	/**
	 * Constructor that add the two filters one into the native WP filter from
	 * where the images are generated and a custom one to handle images sizes.
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( KATANA_WP_FILTER, array( $this, 'filter' ) );
		add_filter( KATANA_FILTER, array( $this, 'refine' ), 10, 2 );
	}

	/**
	 * WP default filter that runs before the images are being generated, then
	 * appplies the custom filter from Katana.
	 *
	 * @url http://codex.wordpress.org/Plugin_API/Filter_Reference/intermediate_image_sizes.html
	 * @param array $sizes The register sizes of images in WP.
	 * @return array $sizes The array of sizes
	 * @since 1.0.0
	 */
	public function filter( $sizes ) {
		return apply_filters( KATANA_FILTER, $sizes, $this->get_the_id() );
	}

	/**
	 * Allow access to the current post_id using the $_REQUEST variable
	 *
	 * @return int Return a int from 0 to n, that represents the current post id
	 */
	public function get_the_id() {
		return isset( $_REQUEST ) && isset( $_REQUEST['post_id'] )
			? absint( $_REQUEST['post_id'] )
			: 0;
	}

	/**
	 * Custom filter that applies filters for custom post types and using only
	 * the ID of the post
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $ID The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function refine( $sizes, $ID ) {
		if ( 0 === $ID ) {
			return $sizes;
		}
		$sizes = $this->post_id_filter( $sizes, $ID );
		$sizes = $this->post_type_filter( $sizes, $ID );
		return $sizes;
	}

	/**
	 * Creates a filter based on the post_id like: katana_refine_%d
	 * where %d is any post_id.
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $ID The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function post_id_filter( $sizes, $ID ) {
		$filter_name = sprintf( '%s_%d', KATANA_FILTER, $ID );
		return apply_filters( $filter_name, $sizes );
	}

	/**
	 * Creates a filter based on the post_type like: katana_refine_%s
	 * where %s is the post type can be: 'post', 'page' or a custom one.
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $ID The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function post_type_filter( $sizes, $ID ) {
		$type = get_post_type( $ID );
		if ( '' !== $type ) {
			$filter_name = sprintf( '%s_%s', KATANA_FILTER, $type );
			$sizes = apply_filters( $filter_name, $sizes );
		}
		return $sizes;
	}
}
