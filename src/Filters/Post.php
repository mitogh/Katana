<?php namespace Katana\Filters;

use Katana\Helpers\Config;

/**
 * Attach specifc filters associated with a post.
 *
 * @since 2.0.0
 */
class Post {

	/**
	 * Constructor that register the filters to associated with the class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_filter( Config::KATANA_FILTER, [ $this, 'filter_by_post_id' ] );
		add_filter( Config::KATANA_FILTER, [ $this, 'filter_by_post_type' ] );
	}

	/**
	 * Creates a filter based on the post_id like: katana_refine_%d
	 * where %d is any post_id.
	 *
	 * @since 1.0.0
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $post_id The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function filter_by_post_id( $sizes, $post_id = 0 ) {
		return apply_filters( Formatter::katana_filter( $post_id ), $sizes );
	}

	/**
	 * Creates a filter based on the post_type like: katana_refine_%s
	 * where %s is the post type can be: 'post', 'page' or a custom one.
	 *
	 * @since 1.0.0
	 *
	 * @param array $sizes The images sizes.
	 * @param int   $post_id The id of the post, page or custom post type.
	 * @return return the array with the new sizes.
	 */
	public function filter_by_post_type( $sizes, $post_id = 0 ) {
		$type = get_post_type( $post_id );
		if ( empty( $type ) ) {
			return $sizes;
		} else {
			return apply_filters( Formatter::katana_filter( $type ), $sizes );
		}
	}
}
