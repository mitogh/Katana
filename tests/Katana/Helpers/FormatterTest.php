<?php namespace Katana\Helpers;

class FormatterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider namesPack
	 */
	public function testToFilterName( $name, $expected ){
		$updated_name = Formatter::remove_extension( $name );
		$this->assertEquals( $expected, Formatter::to_filter_name( $updated_name ) );
	}

	public function namesPack(){
		return array(
			array( '', '' ),
			array( 'page-templates/default', 'page_templates_default' ),
			array( 'page-templates/contact-page', 'page_templates_contact_page' ),
			array( 'contact-page', 'contact_page' ),
			array( 'contact-PAGE.PHP', 'contact_page' ),
		);
	}

	/**
	 * @dataProvider extensionsPack
	 */
	public function testRemoveExtension( $file, $expected ){
		$this->assertEquals( $expected, Formatter::remove_extension( $file ) );
	}

	public function extensionsPack(){
		return array(
			array( 'index.php', 'index' ),
			array( 'dir/subdir/another/index.php', 'dir/subdir/another/index' ),
			array( 'movies.js', 'movies' ),
			array( 'movies.js.php.css', 'movies' ),
			array( 'letter.txt','letter' ),
			array( '', '' ),
		);
	}
}

