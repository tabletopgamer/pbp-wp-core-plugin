<?php
/**
 * User: tabletopgamer
 * Date: 19.01.2015
 * Time: 18:11
 */

namespace PbP_WP\Custom_Posts;


use PbP_WP\Custom_Posts\Types\ICustom_Post_Type_Factory;
use PbP_WP\WordPress_Posts\IWordPress_Post_Repository;

class Custom_Post_Repository implements ICustom_Post_Repository {
	/**
	 * @var IWordPress_Post_Repository
	 */
	private $post_repository;
	/**
	 * @var ICustom_Fields_Repository
	 */
	private $fields_repository;
	/**
	 * @var ICustom_Post_Type_Factory
	 */
	private $post_type_factory;

	/**
	 * @param IWordPress_Post_Repository $post_repository
	 * @param ICustom_Fields_Repository $fields_repository
	 * @param ICustom_Post_Type_Factory $post_type_factory
	 */
	function __construct(
		IWordPress_Post_Repository $post_repository, ICustom_Fields_Repository $fields_repository,
		ICustom_Post_Type_Factory $post_type_factory
	) {

		$this->post_repository   = $post_repository;
		$this->fields_repository = $fields_repository;
		$this->post_type_factory = $post_type_factory;
	}

	/**
	 * @param $id
	 *
	 * @return ICustom_Post
	 */
	function get_by_id( $id ) {
		$post = $this->post_repository->get_by_id( $id );

		$custom_type = $this->post_type_factory->get_post_type($post->get_type());

		$fields = $this->fields_repository->get_custom_fields( $id,
			$this->get_field_names( $custom_type ) );

		return new Custom_Post($post, $fields);
	}

	/**
	 * @param array int[] $entityIds
	 *
	 * @return ICustom_Post[]
	 */
	public function get_by_ids( array $post_ids ) {
		// TODO: Implement get_by_ids() method.
	}

	/**
	 * @param ICustom_Post_Type $custom_type
	 *
	 * @return array
	 */
	private function get_field_names( $custom_type ) {

		return array_map( function ( Custom_Field $type ) {
			return $type->get_name();
		}, $custom_type->get_post_fields() );
	}


}