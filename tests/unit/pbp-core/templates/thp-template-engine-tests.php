<?php
use PbP_Core\Repository\IContent_Repository;
use PbP_Core\Templates\Thp_Template_Engine;

/**
 * @coversDefaultClass PbP_Core\Templates\Thp_Template_Engine
 */
class ThP_Template_Engine_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @var IContent_Repository
	 */
	private $contentRepo;
	/**
	 * @var Thp_Template_Engine
	 */
	private $sut;

	public function setUp() {
		$this->contentRepo = $this->getMockBuilder( 'PbP_Core\Repository\IContent_Repository' )
		                          ->getMock();

		$this->sut = new Thp_Template_Engine( $this->contentRepo );
	}

	/**
	 * @covers ::EMPTY_OBJECT
	 * @test
	 */
	public function EMPTY_OBJECT_CalledTwice_WillReturnSameInstance() {
		$this->contentRepo->method( 'get_content' )
		                  ->willReturn( 'cool_string' );

		$result = $this->sut->render('fake_path', []);

		$this->assertSame( 'cool_string', $result);

	}
}