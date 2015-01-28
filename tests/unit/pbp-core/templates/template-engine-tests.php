<?php
use PbP_Core\Repository\IContent_Repository;
use PbP_Core\Templates\Template_Engine;

/**
 * @coversDefaultClass PbP_Core\Templates\Template_Engine
 */
class Template_Engine_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @var IContent_Repository
	 */
	private $contentRepo;
	/**
	 * @var Template_Engine_Impl_Test
	 */
	private $sut;

	public function setUp() {
		$this->contentRepo = $this->getMockBuilder( 'PbP_Core\Repository\IContent_Repository' )
		                          ->getMock();

		$this->contentRepo->method( 'get_content' )
		                  ->willReturn( 'content' );

		$this->sut = new Template_Engine_Impl_Test( $this->contentRepo );

	}

	/**
	 * @covers ::get_template
	 * @covers ::add_template
	 * @covers ::is_template_loaded
	 * @covers ::add_template
	 * @test
	 */
	public function render_CalledOnce_CallsLoadTemplateOnlyOnce() {
		$template = 'the/template/path';

		$this->sut->render( $template, [ 'a' => 'b' ] );

		$this->assertEquals( 1, $this->sut->get_load_template_count() );
	}

	/**
	 * @covers ::get_template
	 * @covers ::add_template
	 * @covers ::is_template_loaded
	 * @covers ::add_template
	 * @test
	 */
	public function render_CalledMultiplTimes_WithSameTemplate_AndSameModel_CallsLoadTemplateOnlyOnce() {
		$template = 'the/template/path';

		$this->sut->render( $template, [ 'a' => '1' ] );
		$this->sut->render( $template, [ 'a' => '1' ] );
		$this->sut->render( $template, [ 'a' => '1' ] );
		$this->sut->render( $template, [ 'a' => '1' ] );

		$this->assertEquals( 1, $this->sut->get_load_template_count() );
	}

	/**
	 * @covers ::get_template
	 * @covers ::add_template
	 * @covers ::is_template_loaded
	 * @covers ::add_template
	 * @test
	 */
	public function render_CalledMultiplTimes_WithSameTemplate_AndDifferentModels_CallsLoadTemplateOnlyOnce() {
		$template = 'the/template/path';

		$this->sut->render( $template, [ 'a1' => '1' ] );
		$this->sut->render( $template, [ 'a2' => '2' ] );
		$this->sut->render( $template, [ 'a3' => '3' ] );
		$this->sut->render( $template, [ 'a4' => '4' ] );

		$this->assertEquals( 1, $this->sut->get_load_template_count() );
	}

	/**
	 * @covers ::get_template
	 * @covers ::add_template
	 * @covers ::is_template_loaded
	 * @covers ::add_template
	 * @test
	 */
	public function render_CalledMultiplTimes_WithDifferentTemplates_CallsLoadTemplateEveryTime() {

		$this->sut->render( 'first/template/path', [ ] );
		$this->sut->render( 'second/template/path', [ ] );
		$this->sut->render( 'third/template/path', [ ] );

		$this->assertEquals( 3, $this->sut->get_load_template_count() );
	}
}

/***
 * Class Template_Engine_Impl_Test used for testing the abstract class Template_Engine
 *
 * @codeCoverageIgnore
 */
class Template_Engine_Impl_Test extends Template_Engine {

	private $load_template_count = 0;

	/**
	 * @return mixed
	 */
	public function get_load_template_count() {
		return $this->load_template_count;
	}

	/**
	 * @param $content
	 * @param array $model
	 *
	 * @return string The content after evaluation. It should be in the ready for display state.
	 */
	protected function evaluate_content( $content, $model ) {
		return $content;
	}

	/***
	 * @param mixed $template
	 *
	 * @return string The template body.
	 */
	protected function load_template( $template ) {
		$this->load_template_count ++;

		return $template;
	}
}