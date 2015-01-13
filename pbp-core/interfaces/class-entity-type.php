<?php namespace PbP_Core\Interfaces;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */
class Entity_Type extends Enum_Base{
	const CARD      = 'tabletop_card';
	const GAME      = 'tabletop_game';
	const CHARACTER = 'tabletop_character';
	const UNKNOWN   = 'undefined';
		
	/**
	 * @return string
	 */
	protected function GetDefaultValue() {
		return self :: UNKNOWN;
	}
	
	/**
	 * @return array[string];
	 */
	protected function GetAllowedValues() {
		return array (
			self :: CARD,
			self :: GAME,
			self :: CHARACTER,
		);
	}
}
