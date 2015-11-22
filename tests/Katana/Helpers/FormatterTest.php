<?php

namespace Katana\Helpers;

class FormatterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider provider
	 */
	public function testRemovalExtension( $file, $expected ){
		$this->assertEquals( $expected, Formatter::remove_extension( $file ) );
	}

	public function provider(){
		return array(
			array( 'index.php', 'index' ),
			array( 'dir/subdir/another/index.php', 'dir/subdir/another/index' ),
			array( 'movies.js', 'movies' ),
			array( 'letter.txt','letter' ),
			array( '', '' ),
		);
	}
}

