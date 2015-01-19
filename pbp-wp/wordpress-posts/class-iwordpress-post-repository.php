<?php
/**
 * User: tabletopgamer
 * Date: 18.01.2015
 * Time: 15:47
 */
namespace PbP_WP\WordPress_Posts;

interface IWordPress_Post_Repository {
	/**
	 * @param array int[] $entityIds
	 *
	 * @return IWordPress_Post[]
	 */
	public function get_by_ids( array $post_ids );

	/**
	 * @param int $post_id
	 *
	 * @return IWordPress_Post
	 */
	public function get_by_id( $post_id );
}