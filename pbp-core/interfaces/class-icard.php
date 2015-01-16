<?php namespace PbP_Core\Interfaces;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */
interface ICard extends IEntity{
	
	/**
	 * @return int Returns the number of cards in hand/deck
	 */
    function get_card_count();
	
	/**
	 * @return int Returns the card type
	 */
    function get_card_type();
}
