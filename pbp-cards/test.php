<?php
/**
 * User: tabletopgamer
 * Date: 19.01.2015
 * Time: 18:06
 */

namespace PbP_Cards;


use PbP_Core\Repository\Entity_Type;
use PbP_Core\Repository\ICard;

class CardImplTest implements ICard{

	/**
	 * @return int Returns the number of cards in hand/deck
	 */
	function get_card_count() {
		// TODO: Implement get_card_count() method.
	}

	/**
	 * @return int Returns the card type
	 */
	function get_card_type() {
		// TODO: Implement get_card_type() method.
	}

	/**
	 * @return int
	 */
	function get_id() {
		// TODO: Implement get_id() method.
	}

	/**
	 * @return Entity_Type
	 */
	function  get_type() {
		// TODO: Implement get_type() method.
	}
}