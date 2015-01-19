<?php
/**
 * User: tabletopgamer
 * Date: 18.01.2015
 * Time: 15:47
 */
namespace PbP_WP\Custom_Posts;

interface ICustom_Fields_Repository {

	/**
	 * @param int $post_id
	 * @param array $custom_keys The keys of the meta that needs to be retrieved.
	 *
	 * @return array
	 */
	public function get_custom_fields( $post_id, array $custom_keys );
}