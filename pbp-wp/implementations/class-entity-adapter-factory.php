<?php namespace PbP_WP\Implementations;
/**
 * User: tabletopgamer
 * Date: 14.01.2015
 * Time: 04:07
 */

use PbP_Core\Interfaces\Entity_Type;
use PbP_Core\Interfaces\IEntity;
use PbP_WP\Interfaces\IEntity_Adapter_Factory;

class Entity_Adapter_Factory implements IEntity_Adapter_Factory {

	/**
	 * @param Entity_Type $entity_type
	 * @return IEntity
	 */
	public function get_entity_adapter(\WP_Post $post) {

		switch ($post->post_type) {
			case Entity_Type::CARD() :
				return new Custom_Post_Entity_Adapter($post);
		}

		return new Custom_Post_Entity_Adapter($post);
	}
}