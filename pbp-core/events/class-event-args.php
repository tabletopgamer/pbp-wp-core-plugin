<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 10:53
 */

namespace PbP_Core\Events;

class Event_Args {

	/**
	 * @var Event_Args
	 */
	private static $null_object;

	/**
	 * @return Event_Args
	 */
	public static function EMPTY_OBJECT() {

		if ( ! self::$null_object ) {
			self::$null_object = new Event_Args();
		}

		return self::$null_object;
	}
}