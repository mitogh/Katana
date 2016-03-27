<?php namespace Katana\Helpers;

class ConfigTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Tests the value of the configuration values.
	 */
	public function testConstsValues(){
		$this->assertEquals( 'intermediate_image_sizes', Config::WP_FILTER );
		$this->assertEquals( 'katana_refine', Config::KATANA_FILTER );
		$this->assertEquals( 'katana', Config::KATANA );
	}
}
