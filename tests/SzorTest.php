<?php
class SzorTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider setOfValues
	 */
	function testHasSet( $options, $values ) {
		$szor = new \Szor( $options );
		$this->assertTrue( $szor->has_set( $values ) );
	}

	public function setOfValues(){
		return array(
			array( array(), array() ),
			array(
				array(
					'width' => 0,
				),
				array(
					'width'
				)
			),
			array(
				array(
					'height' => 1,
					'name' => 2,
					'a' => 3,
					'b' => 3,
					'c' => 3,
					'width' => 0,
				),
				array( 'width', 'a' )
			),
			array(
				array(
					'height' => 1,
					'name' => 2,
					'a' => 3,
					'b' => 3,
					'c' => 3,
					'width' => 0,
				),
				array( 'width' )
			),
		);
	}
}
