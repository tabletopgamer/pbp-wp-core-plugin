<?php
use PbP_WP\Custom_Posts\Custom_Fields_Repository;

/**
 * @coversDefaultClass PbP_WP\Custom_Posts\Custom_Post_Repository
 */
class Custom_Fields_Repository_Tests extends WP_UnitTestCase {

	/**
	 * @var \PbP_WP\Custom_Posts\Custom_Fields_Repository
	 */
	protected $sut;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function setUp() {
		parent::setUp();

		$this->sut = new Custom_Fields_Repository();
	}

	/**
	 * @covers ::get_custom_fields
	 * @test
	 */
	public function get_custom_fields_WithNoKeys_ForPostWithNoCustomFields_ReturnsEmptyArray() {
		$post_id = $this->factory->post->create();
		$keys    = [ ];

		$results = $this->sut->get_custom_fields( $post_id, $keys );

		$this->assertEquals( 0, count( $results ) );
	}

	/**
	 * @covers ::get_custom_fields
	 * @test
	 */
	public function get_custom_fields_WithOneKey_ForPostWithNoCustomFields_ThrowsException() {
		$keys    = [ 'in_existing_meta_key' ];
		$post_id = $this->factory->post->create();

		$this->setExpectedException( 'InvalidArgumentException', "'in_existing_meta_key' is not valid" );

		$this->sut->get_custom_fields( $post_id, $keys );
	}

	/**
	 * @covers ::get_custom_fields
	 * @test
	 */
	public function get_custom_fields_WithTwoKeys_ForPostWithOneCustomField_ThrowsException() {
		$keys    = [ 'existing_meta_key', 'in_existing_meta_key' ];
		$post_id = $this->factory->post->create();
		update_post_meta( $post_id, 'existing_meta_key', 'the_key' );

		$this->setExpectedException( 'InvalidArgumentException', "'in_existing_meta_key' is not valid" );

		$this->sut->get_custom_fields( $post_id, $keys );
	}

	/**
	 * @covers ::get_custom_fields
	 * @covers ::normalize_meta_value
	 * @test
	 */
	public function get_custom_fields_WithOneKey_ForPostWithOneCustomField_ReturnsThatValue() {
		$keys    = [ 'existing_meta_key' ];
		$post_id = $this->factory->post->create();
		update_post_meta( $post_id, 'existing_meta_key', 'test' );

		$result = $this->sut->get_custom_fields( $post_id, $keys );

		$this->assertEqualSetsWithIndex( [ 'existing_meta_key' => 'test' ], $result );
	}

	/**
	 * @covers ::get_custom_fields
	 * @covers ::normalize_meta_value
	 * @test
	 */
	public function get_custom_fields_WithOneKey_ForPostWithTwoCustomField_ReturnsThatCustomField() {
		$keys    = [ 'existing_meta_key' ];
		$post_id = $this->factory->post->create();
		update_post_meta( $post_id, 'existing_meta_key', 'the_key' );
		update_post_meta( $post_id, 'un_existing_meta_key', 'the_other_key' );

		$result = $this->sut->get_custom_fields( $post_id, $keys );

		$this->assertEqualSetsWithIndex( [ 'existing_meta_key' => 'the_key' ], $result );
	}

	/**
	 * @covers ::get_custom_fields
	 * @covers ::normalize_meta_value
	 * @test
	 */
	public function get_custom_fields_ForPostWithArrayCustomField_ReturnsTheArray() {
		$keys    = [ 'existing_meta_key' ];
		$post_id = $this->factory->post->create();
		update_post_meta( $post_id, 'existing_meta_key', [ 'value_1', 'value_2' ] );

		$result = $this->sut->get_custom_fields( $post_id, $keys );

		$this->assertEqualSetsWithIndex( [ 'existing_meta_key' => [ 'value_1', 'value_2' ] ], $result );
	}


}