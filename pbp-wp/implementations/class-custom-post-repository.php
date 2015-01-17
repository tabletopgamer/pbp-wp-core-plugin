<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:37
 */

namespace PbP_WP\Implementations;


use PbP_WP\Interfaces\ICustom_Post;

class Custom_Post_Repository {

	/**
	 * @param array [int] $entityIds
	 *
	 * @return ICustom_Post[] An array containing all entities for the specified ids.
	 * If no entities could be found, then an emtpy array is returned.
	 */
	public function get_by_ids( array $postIds ) {

		$args = array( 'post__in' => $postIds );

		$wpPosts = \get_posts( $args );

		$entities = array();

		if ( count( $wpPosts ) > 0 ) {
			foreach ( $wpPosts as $wpPost ) {
				$entities[] = $this->post_type_factory->create_post( $wpPost );

			}
		}

		return $entities;
	}

	/**
	 * @param int $entityId
	 *
	 * @return ICustom_Post
	 */
	public function get_by_id( $entityId ) {

		if ( ! is_numeric( $entityId ) ) {
			throw new \InvalidArgumentException( 'EntityId must not be null' );
		}

		$result = null;
		$wpPost = \get_post( $entityId );

		if ( $wpPost !== null ) {
			$result = $this->create_custom_post( $wpPost );
			$result->set_id( $wpPost->ID );
		}

		return $result;
	}

	/**
	 * @param \WP_Post $wpPost
	 *
	 * @return ICustom_Post
	 */
	private function create_custom_post( $wpPost ) {
		$custom_post = $this->post_type_factory->create_post( $wpPost );

		$post_meta = \get_post_custom( $wpPost->ID );
		foreach ($post_meta as $meta){
		//	$custom_post->set_fields()
		}

		return $custom_post;
	}
}