<?php namespace PbP_Core\Interfaces;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */
interface Entity_Interface {
	
	/**
	 * @return int
	 */
    function get_id();
	
	/**
	 * @return Entity_Type
	 */
    function  get_type();
}
