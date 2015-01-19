<?php
use PbP_WP\WordPress_Posts\WordPress_Post_Repository;
use PbP_WP\WordPress_Posts\WPPost_To_WordPress_Post_Adapter_Factory;

/**
 * @coversDefaultClass PbP_WP\WordPress_Posts\WordPress_Post_Repository
 */
class WordPress_Post_Repository_Tests extends WP_UnitTestCase {

	/**
	 * @var \PbP_WP\WordPress_Posts\WordPress_Post_Repository
	 */
	protected $sut;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function setUp() {
		parent::setUp();

		$wp_post_adapter = new WPPost_To_WordPress_Post_Adapter_Factory();
		$this->sut       = new WordPress_Post_Repository( $wp_post_adapter );
	}

	/**
	 * @covers ::get_by_id
	 * @test
	 */
	public function get_by_id_WithExistingPostId_ReturnsThatPost() {
		$post_id = $this->factory->post->create();

		$result = $this->sut->get_by_id( $post_id );

		$this->assertEquals( $post_id, $result->get_id() );
	}


	/**
	 * @covers ::get_by_id
	 * @test
	 */
	public function get_by_id_WithInExistingPostId_ReturnsNull() {
		$post_id = 1000;

		$result = $this->sut->get_by_id( $post_id );

		$this->assertEquals( null, $result );
	}

	/**
	 * @covers ::get_by_ids
	 * @test
	 */
	public function get_by_ids_WithOneEntityId_OfExistingPost_ReturnsListWithOnePost() {
		$post_id = $this->factory->post->create();

		$results = $this->sut->get_by_ids( [ $post_id ] );

		$this->assertEquals( 1, count( $results ) );
	}

	/**
	 * @covers ::get_by_ids
	 * @test
	 */
	public function get_by_ids_WithOneEntityId_OfInexistingPost_ReturnsEmptyList() {
		$post_id = 1000;

		$results = $this->sut->get_by_ids( [ $post_id ] );

		$this->assertEquals( 0, count( $results ) );
	}


	/**
	 * @covers ::get_by_ids
	 * @test
	 */
	public function get_by_ids_WithThreeEntityIds_OfExistingPosts_ReturnsEmptyList() {
		$post_id1 = 1001;
		$post_id2 = 1002;

		$results = $this->sut->get_by_ids( [ $post_id1, $post_id2 ] );

		$this->assertEquals( 0, count( $results ) );
	}

}