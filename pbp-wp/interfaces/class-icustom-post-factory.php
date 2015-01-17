<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 16:49
 */
namespace PbP_WP\Interfaces;

use PbP_Core\Repository\Entity_Type;

interface ICustom_Post_Factory {
	/**
	 * @param \WP_Post $type
	 *
	 * @return ICustom_Post
	 */
	public function create_post( \WP_Post $post );

	/**
	 * @param Entity_Type $type
	 *
	 * @return ICustom_Post
	 */
	public function create_post_from_entity_type( $entity_type );
}