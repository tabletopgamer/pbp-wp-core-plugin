<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:37
 */

namespace PbP_WP\WordPress_Posts;


class WordPress_Post_Repository implements IWordPress_Post_Repository {
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
	 * @param int $post_id
	 *
	 * @return IWordPress_Post
	 */
	public function get_by_id( $post_id ) {

		if ( ! is_numeric( $post_id ) ) {
			throw new \InvalidArgumentException( "Argument 'post_id' must be a number. '$post_id' value not valid." );
		}

		$result  = null;
		$wp_post = \get_post( $post_id );

		if ( $wp_post !== null ) {
			$result = $this->get_post( $wp_post );
		}

		return $result;
	}

	/**
	 * @param \WP_Post $wp_post
	 *
	 * @return IWordPress_Post
	 */
	private function get_post( $wp_post ) {

		return $this->adapter_factory->create_adapter( $wp_post );;
	}
}