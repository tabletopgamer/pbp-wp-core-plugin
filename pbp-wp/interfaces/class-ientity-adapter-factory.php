<?php
/**
 * User: tabletopgamer
 * Date: 14.01.2015
 * Time: 04:15
 */
namespace PbP_WP\Interfaces;

use PbP_Core\Interfaces\Entity_Type;
use PbP_Core\Interfaces\IEntity;

interface IEntity_Adapter_Factory {
	/**
	 * @param \WP_Post $post
	 *
	 * @return IEntity
	 */
	public function get_entity_adapter( \WP_Post $post );
}