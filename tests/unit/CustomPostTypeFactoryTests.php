<?php

use PbP_Core\Interfaces\Entity_Type;
use PbP_WP\Implementations\Custom_Post_Type_Factory;

/**
 * @coversDefaultClass PbP_WP\Implementations\Custom_Post_Type_Factory
 */
class Custom_Post_Type_Factory_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @var Custom_Post_Type_Factory
	 */
	protected $sut;

	public function setUp() {
		$this->sut = new Custom_Post_Type_Factory();
	}

	/**
	 * @covers ::get_type
	 */
	public function testGetType_WithExistingType_ReturnsCorrectPostType() {
		$existingType = Entity_Type::CARD();

		$result = $this->sut->get_type( $existingType );

		$this->assertEquals( $result->get_post_type(), Entity_Type::CARD() );
	}

	/**
	 * @covers ::get_type
	 */
	public function testGetType_WithInExistingType_ThrowsException() {

		$this->setExpectedException('Exception', "no CustomPostType defined");

		$this->sut->get_type( Entity_Type::UNKNOWN() );


	}
}
