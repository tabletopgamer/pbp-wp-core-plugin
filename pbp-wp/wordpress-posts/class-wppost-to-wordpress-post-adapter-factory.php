<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 18:07
 */

namespace PbP_WP\WordPress_Posts;

use PbP_WP\Interfaces\IWordPress_Post;
use PbP_WP\Interfaces\IWordPress_Post_Adapter_Factory;

class WPPost_To_WordPress_Post_Adapter_Factory implements IWordPress_Post_Adapter_Factory {


	/**
	 * @param IWordPress_Post $type
	 *
	 * @return IWordPress_Post
	 */
	public function create_adapter( \WP_Post $post ) {
		return new WPPost_To_WordPress_Post_Adapter( $post );
	}
}