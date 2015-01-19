<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 11:45
 */

namespace PbP_WP\Custom_Posts;


use PbP_Core\Util\Enum;

/**
 * Class Input_Type
 * @package PbP_WP
 *
 * @method static SHORT_TEXT()
 * @method static LONG_TEXT()
 * @method static NUMBER()
 * @method static IMAGE()
 */
class Input_Type extends Enum {
	protected static $SHORT_TEXT;
	protected static $LONG_TEXT;
	protected static $NUMBER;
	protected static $IMAGE;
}
