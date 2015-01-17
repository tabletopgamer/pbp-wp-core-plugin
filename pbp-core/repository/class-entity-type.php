<?php namespace PbP_Core\Repository;

use PbP_Core\Util\Enum;

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
	protected static $CARD = 'card';
	protected static $GAME = 'game';
	protected static $CHARACTER = 'character';
	protected static $UNKNOWN = 'unknown';
}
