<?php namespace Katana\Helpers;

/**
 * Class that holds all of the config and constant values for the class.
 */
class Config {
	/**
	 * Wordpress native filter that runs before the sizes of images are generated,
	 * where all others filters are attached.
	 *
	 * @since 1.0.0
	 */
	const WP_FILTER = 'intermediate_image_sizes';

	/**
	 * Prefix of all of the Katana filters, compatible with version 1.0,0
	 *
	 * @since 1.0.0
	 */
	const KATANA_FILTER = 'katana_refine';

	/**
	 * Prefix of all of the Katana filters
	 *
	 * @since 2.0.0
	 */
	const KATANA = 'katana';
}
