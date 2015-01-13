<?php
namespace PbP_WP\Implementations;

use PbP_Core\Interfaces\Entity_Types;

class PBP_WP_POST_TYPES {
	/**
	 * @var PbP_WP_Post_Type 
	 */
	public static $CARD;
	
	/**
	 * @var PbP_WP_Post_Type 
	 */
	public static $GAME;
	
	/**
	 * @var PbP_WP_Post_Type 
	 */
	public static $CHARACTER;
	
	/**
	 * @var PbP_WP_Post_Type 
	 */
	public static $UNKNOWN;
	
	
	private static $all_types;
	
	public static function initialize(){
		self::$UNKNOWN   = new PbP_WP_Post_Type( Entity_Types::UNKNOWN,'','');
		self::$CARD      = new PbP_WP_Post_Type( Entity_Types::CARD,'PbP Card','PbP Cards');
		self::$GAME      = new PbP_WP_Post_Type( Entity_Types::GAME,'PbP Game','PbP Games');
		self::$CHARACTER = new PbP_WP_Post_Type( Entity_Types::CHARACTER ,'PbP Character','PbP Characters');
		
		self::$all_types = array(
			self::$CARD->get_post_type()      => self::$CARD,
			self::$GAME->get_post_type()      => self::$GAME,
			self::$CHARACTER->get_post_type() => self::$CHARACTER,
		);
		
	}
	
	public static function get_type( $type ){
		if (!is_array(self::$all_types) || count(self::$all_types) == 0){
			throw new \RuntimeException("You need to call: " . __CLASS__ . ":initialized()  before calling get_type() !");
		}
			
		return isset( self::$all_types[$type] ) 
		? self::$all_types[$type] 
		: self::$UNKNOWN;
	}
	
	public static function deinitialize(){
		self :: $all_types = NULL;
	}
}
	
	