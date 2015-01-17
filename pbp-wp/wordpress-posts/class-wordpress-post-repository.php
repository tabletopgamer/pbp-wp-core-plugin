<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:37
 */

namespace PbP_WP\WordPress_Posts;


use PbP_WP\Interfaces\IWordPress_Post;
use PbP_WP\Interfaces\IWordPress_Post_Adapter_Factory;

class WordPress_Post_Repository {
	/**
	 * @var IWordPress_Post_Adapter_Factory
	 */
	private $adapter_factory;

	/**
	 * @param IWordPress_Post_Adapter_Factory $adapter_factory
	 */
	public function __construct( IWordPress_Post_Adapter_Factory $adapter_factory ) {

		$this->adapter_factory = $adapter_factory;
	}

	/**
	 * @param array int[] $entityIds
	 *
	 * @return IWordPress_Post[]
	 */
	public function get_by_ids( array $post_ids ) {

		$wp_posts = \get_posts( [ 'post__in' => $post_ids ] );

		$posts = array();

		if ( count( $wp_posts ) > 0 ) {
			foreach ( $wp_posts as $wp_post ) {
				$posts[] = $this->get_post( $wp_post );
			}
		}

		return $posts;
	}

	/**
	 * @param int $entityId
	 *
	 * @return IWordPress_Post
	 */
	public function get_by_id( $entityId ) {

		if ( ! is_numeric( $entityId ) ) {
			throw new \InvalidArgumentException( 'EntityId must not be null' );
		}

		$result = null;
		$wpPost = \get_post( $entityId );

		if ( $wpPost !== null ) {
			$result = $this->get_post( $wpPost );
		}

		return $result;
	}

	/**
	 * @param \WP_Post $wpPost
	 *
	 * @return IWordPress_Post
	 */
	private function get_post( $wpPost ) {

		return $this->adapter_factory->create_adapter( $wpPost );;
	}
}