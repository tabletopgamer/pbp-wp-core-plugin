<?php
/**
 * User: tabletopgamer
 * Date: 19.01.2015
 * Time: 19:47
 */


use PbP_WP\Custom_Posts\Types\Custom_Post_Type_Factory;

/**
 * @coversDefaultClass  PbP_WP\Custom_Posts\Types\Custom_Post_Type_Factory
 */
class Custom_Post_Type_Factory_Tests extends \PHPUnit_Framework_TestCase {

	/**
	 * @covers ::get_post_type
	 * @test
	 */
	public function get_post_type_WithNoKnownTypes_ThrowsException() {

		$sut = $this->get_sut( [ ] );
		$this->setExpectedException( 'Exception', 'no Custom_Post_Type defined' );

		$sut->get_post_type( 'unknown type' );
	}

	/**
	 * @covers ::get_post_type
	 * @test
	 */
	public function get_post_type_WithKnownType_WillReturnThatType() {
		$knownType = $this->getMockBuilder( 'PbP_WP\Custom_Posts\ICustom_Post_Type' )
		                  ->getMock();

		$knownType->method( 'get_type_name' )
		          ->will( 'known_type' );

		$sut = $this->get_sut( [ $knownType ] );
		//$this->setExpectedException( 'Exception', 'no Custom_Post_Type defined' );

		$result = $sut->get_post_type( 'known_type' );

		$this->assertEquals( $knownType, $result );
	}

	/**
	 * @param ICustom_Post_Type []
	 *
	 * @return Custom_Post_Type_Factory
	 */
	public function get_sut( $known_types ) {
		return new Custom_Post_Type_Factory( $known_types );
	}
}
