<?php
/**
 * Katana filters
 * @package Katana
 *
 * @since 1.0.0
 */

namespace Katana;


/**
 * Katana is a simple filters system to allow user define the only required sizes
 * for the images beein generated from the function `add_image_size`, this will
 * help to decrease the size of the images where sometimes are not required.
 * @package Katana
 */
class Katana {
	/**
	 * Wordpress filter that runs before the sizes of images are generated
	 * @since 1.0.0
	 */
	const WORDPRESS_FILTER = 'intermediate_image_sizes';

	/**
	 * Prefix of all of the Katana filters
	 * @since 1.0.0
	 */
	const KATANA_FILTER = 'katana_refine';

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
	 * @since 1.0.0
	 *
	 * @lik http://codex.wordpress.org/Plugin_API/Filter_Reference/intermediate_image_sizes.html
	 *
	 * @param array $sizes The register sizes of images in WP.
	 * @return array $sizes The array of sizes
	 */
	public function filter( $sizes ) {
		return apply_filters( KATANA_FILTER, $sizes, $this->get_the_id() );
	}

	/**
	 * Allow access to the current post_id using the $_REQUEST variable
	 *
	 * @since 1.0.0
	 *
	 * @return int Return a int from 0 to n, that represents the current post id
	 */
	public function get_the_id() {
		return isset( $_REQUEST['post_id'] ) ?  absint( $_REQUEST['post_id'] ) : 0;
	}

	/**
	 * Custom filter that applies filters for custom post types and using only
	 * the ID of the post
	 *
	 * @since 1.0.0
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
		$sizes = $this->page_template_filter( $sizes, $ID );
		return $sizes;
	}

	/**
	 * Creates a filter based on the post_id like: katana_refine_%d
	 * where %d is any post_id.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $ID The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function post_type_filter( $sizes, $ID ) {
		$type = get_post_type( $ID );
		if ( empty( $type ) ) {
			return $sizes;
		}
		$filter_name = sprintf( '%s_%s', KATANA_FILTER, $type );
		return apply_filters( $filter_name, $sizes );
	}

	/**
	 * Filter that allow to change the sizes on pages that uses custom
	 * page templates.
	 *
	 * @since 1.1.0
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $ID The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function page_template_filter( $sizes, $ID ) {
		$template = get_page_template_slug( $ID );
		if ( empty( $template ) ) {
			return $sizes;
		}
		$suffix_name = $this->create_filter_name( $template );
		$filter_name = sprintf( '%s_%s', KATANA_FILTER, $suffix_name );
		return apply_filters( $filter_name, $sizes );
	}

}
