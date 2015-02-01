<?php
use PbP_Core\Repository\IContent_Repository;
use PbP_Core\Templates\Sanitizers\Simple_Model_Sanitizer;
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

		$sanitizer = new Simple_Model_Sanitizer();
		$this->sut = new Thp_Template_Engine( $this->contentRepo, $sanitizer);
	}

	/**
	 * @covers ::render
	 * @test
	 */
	public function render_CalledTwice_WillReturnSameInstance() {
		$this->contentRepo->method( 'get_content' )
		                  ->willReturn( 'cool_string' );

		$result = $this->sut->render('fake_path', []);

		$this->assertSame( 'cool_string', $result);

	}
}