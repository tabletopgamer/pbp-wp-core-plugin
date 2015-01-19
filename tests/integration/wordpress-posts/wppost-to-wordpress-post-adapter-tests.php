<?php
use PbP_WP\WordPress_Posts\WPPost_To_WordPress_Post_Adapter;

/**
 * @coversDefaultClass \PbP_WP\WordPress_Posts\WPPost_To_WordPress_Post_Adapter
 */
class WPPost_To_WordPress_Post_Adapter_Tests extends \WP_UnitTestCase {

	/**
	 * @param WP_Post $post
	 *
	 * @return WPPost_To_WordPress_Post_Adapter
	 */
	private static function getSut( $post ) {
		return new WPPost_To_WordPress_Post_Adapter( $post );
	}

	/**
	 * @covers ::get_id()
	 * @covers ::get_type()
	 * @covers ::get_title()
	 * @covers ::get_content()
	 * @test
	 */
	public function ctor_WithAValidWPPost_SetsCorrectValues() {
		$post = $this->factory->post->create_and_get(
			[
				'post_type'    => 'some_type',
				'post_title'   => 'some_title',
				'post_content' => 'some_content',
			] );

		$result = self::getSut( $post );

		$this->assertEquals( $post->ID, $result->get_id() );
		$this->assertEquals( $post->post_type, $result->get_type() );
		$this->assertEquals( $post->post_title, $result->get_title() );
		$this->assertEquals( $post->post_content, $result->get_content() );
	}

	/**
	 * @covers ::__construct()
	 * @test
	 */
	public function ctor_WithNullPost_ThrowsException() {

		try {
			self::getSut( null );
		} catch ( \Exception $ex ) {

			// we expect any exception to be thrown, either from type hinting or from constructor itself
			// because of this, the PHPUnit setExpectedException could not be used;
			$this->assertTrue( true );

			return;
		}

		$this->fail( '"null" value should not be allowed in constructor parameter' );
	}
}