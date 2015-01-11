<?php
namespace PbP_Core\Implementations;

class PBP_POST_TYPES {
	/**
	 * @var PbP_Post_Type 
	 */
	public static $CARD;
	
	/**
	 * @var PbP_Post_Type 
	 */
	public static $GAME;
	
	/**
	 * @var PbP_Post_Type 
	 */
	public static $CHARACTER;
	
	/**
	 * @var PbP_Post_Type 
	 */
	public static $UNKNOWN;
	
	
	private static $all_types;
	
	public static function initialize(){
		self::$UNKNOWN   = new PbP_Post_Type('undefined','','');
		self::$CARD      = new PbP_Post_Type('tabletop_card','PbP Card','PbP Cards');
		self::$GAME      = new PbP_Post_Type('tabletop_game','PbP Game','PbP Games');
		self::$CHARACTER = new PbP_Post_Type('tabletop_character','PbP Character','PbP Characters');
		
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
	
	