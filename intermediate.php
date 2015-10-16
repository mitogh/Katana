<?php
define( 'KATANA_WP_FILTER', 'intermediate_image_sizes' );
define( 'KATANA_FILTER', 'katana_refine' );
class Katana {
	public function __construct() {
		add_filter( KATANA_WP_FILTER, array( $this, 'filter' ) );
		add_filter( KATANA_FILTER, array( $this, 'refine' ), 10, 2 );
	}

	public function filter( $sizes ) {
		return apply_filters( KATANA_FILTER, $sizes, $this->get_the_id() );
	}

	public function get_the_id() {
		return isset( $_REQUEST ) && isset( $_REQUEST['post_id'] )
			? absint( $_REQUEST['post_id'] )
			: 0;
	}

	public function refine( $sizes, $ID ) {
		if ( 0 === $ID ) {
			return $sizes;
		}
		$sizes = $this->post_id_hook( $sizes, $ID );
		$sizes = $this->post_type_hook( $sizes, $ID );
		return $sizes;
	}

	public function post_id_hook( $sizes, $ID ) {
		$filter_name = sprintf( '%s_%d', KATANA_FILTER, $ID );
		return apply_filters( $filter_name, $sizes );
	}

	public function post_type_hook( $sizes, $ID ) {
		$type = get_post_type( $ID );
		if ( '' !== $type ) {
			$filter_name = sprintf( '%s_%s', KATANA_FILTER, $type );
			$sizes = apply_filters( $filter_name, $sizes );
		}
		return $sizes;
	}
}
