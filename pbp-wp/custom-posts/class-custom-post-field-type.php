<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 11:45
 */

namespace PbP_WP\Custom_Posts;


use PbP_Core\Util\Enum;

/**
 * Class Custom_Post_Field_Types
 * @package PbP_WP
 *
 * @method static SHORT_TEXT()
 * @method static LONG_TEXT()
 * @method static NUMBER()
 * @method static IMAGE()
 */
class Custom_Post_Field_Type extends Enum {
	protected static $SHORT_TEXT;
	protected static $LONG_TEXT;
	protected static $NUMBER;
	protected static $IMAGE;
}
