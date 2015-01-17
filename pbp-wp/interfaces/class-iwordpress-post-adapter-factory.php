<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:49
 */
namespace PbP_WP\Interfaces;

interface IWordPress_Post_Adapter_Factory {
	/**
	 * @param IWordPress_Post $type
	 *
	 * @return IWordPress_Post
	 */
	public function create_adapter( \WP_Post $post );
}