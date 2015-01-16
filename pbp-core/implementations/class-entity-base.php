<?php namespace PbP_Core\Implementations;

use PbP_Core\Interfaces\IEntity;
use PbP_Core\Interfaces\Entity_Type;

/**
 * Description of class-entity-base
 *
 * @author tabletopgamer
 */
class Entity_Base implements IEntity {
	private $id;
	private $type;
	
	/**
	 * @param type $id
	 * @param Entity_Type $type
	 */
	public function __construct($id, Entity_Type $type) {
		$this->id = $id;
		$this->type	 = $type;
	}
	
	/**
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * @return Entity_Type
	 */
	public function get_type() {
		return $this->type;
	}

}
