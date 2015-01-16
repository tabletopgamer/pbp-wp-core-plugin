<?php namespace PbP_Core\Interfaces;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 *
 * @method static Enum CARD()
 * @method static Enum GAME()
 * @method static Enum CHARACTER()
 * @method static Enum UNKNOWN()
 */
class Entity_Type extends Enum {
	protected static $CARD = 'tabletop_card';
	protected static $GAME = 'tabletop_game';
	protected static $CHARACTER = 'tabletop_character';
	protected static $UNKNOWN = 'undefined';
}
