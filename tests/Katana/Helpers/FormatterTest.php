<?php namespace Katana\Helpers;

class FormatterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider namesPack
	 */
	public function testToFilterName( $name, $expected ){
		$this->assertEquals( $expected, Formatter::to_filter_format( $name ) );
	}

	public function namesPack(){
		return [
			[ '', '' ],
			[ '     _page-template_   ', 'page_template' ],
			[ 'page-templates/default', 'default' ],
			[ 'page-templates/contact-page', 'contact_page' ],
			[ 'contact-page', 'contact_page' ],
			[ 'contact-PAGE.PHP', 'contact_page' ],
		];
	}

	/**
	 * @dataProvider templatesNames
	 */
	public function testGetTemplateName( $template_name, $expected ){
		$this->assertEquals( $expected, Formatter::get_template_name( $template_name ) );
	}

	public function templatesNames() {
		return [
			['', ''],
			['page-templates/template-name', 'template-name'],
			['    page-templates/template-name   ', 'template-name'],
			['customPathToaTemplateName/contact-page', 'contact-page'],
			['customPathToaTemplateName/contact-page.php', 'contact-page'],
			['contact-page.php', 'contact-page'],
		];
	}

	/**
	 * @dataProvider filterParams
	 */
	public function testKatanaFilter( $param, $expected ){
		$this->assertEquals( $expected, Formatter::katana_filter( $param ) );
	}

	public function filterParams(){
		return [
			[ '', Config::KATANA_FILTER ],
			[ '12', Config::KATANA_FILTER . '_12' ],
			[ 'contact_page', Config::KATANA_FILTER . '_contact_page' ],
			[ '_extra_slaslh_before_after_', Config::KATANA_FILTER . '_extra_slaslh_before_after' ],
			[ ' _extra_slaslh_before_after_   ', Config::KATANA_FILTER . '_extra_slaslh_before_after' ],
		];
	}
}

