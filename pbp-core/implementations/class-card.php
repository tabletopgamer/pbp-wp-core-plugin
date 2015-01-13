<?php namespace PbP_Core\Implementations;

use PbP_Core\Interfaces\Card_Interface;

/**
 * Description of Card
 *
 * @author tabletopgamer
 */
class Card  extends Entity_Base implements Card_Interface{

	/**
	 * @var int
	 */
	private $card_count;

	/**
	 * @var string
	 */
	private $card_type;

	/**
	 * @param int $value
	 */	
	public function set_card_count( $value ) {
		$this->card_count = $value;
	}

	/**
	 * @param string $value
	 */
	public function set_card_type( $value ) {
		$this->card_type = $value;
	}
	
	/**
	 * @return int
	 */
	public function get_card_count() {
		return $this->card_count;
	}

	/**
	 * @return string
	 */
	public function get_card_type() {
		return $this->card_type;
	}
}
