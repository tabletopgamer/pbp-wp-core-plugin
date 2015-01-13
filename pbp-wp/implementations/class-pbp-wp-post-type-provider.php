<?php
namespace PbP_WP\Implementations;

use PbP_Core\Interfaces\Entity_Type;

class PbP_WP_Post_Type_Provider {

	private $available_types;
	
	function __construct(){
			
		$this->available_types = array(
			Entity_Type::UNKNOWN   => new PbP_WP_Post_Type( Entity_Type::UNKNOWN,'',''),
			Entity_Type::CARD      => new PbP_WP_Post_Type( Entity_Type::CARD,'PbP Card','PbP Cards'),
			Entity_Type::GAME      => new PbP_WP_Post_Type( Entity_Type::GAME,'PbP Game','PbP Games'),
			Entity_Type::CHARACTER => new PbP_WP_Post_Type( Entity_Type::CHARACTER ,'PbP Character','PbP Characters'),
		);
		
	}
	
	public function get_available_types(){
		return $this->available_types;
	}
	
	/**
	 * 
	 * @param string $type
	 * @return PbP_WP_Post_Type
	 */
	public function get_type( $type ){
			
		return isset( $this->available_types[$type] ) 
		? $this->available_types[$type] 
		: $this->available_types[Entity_Type::UNKNOWN];
	}
}
	
	