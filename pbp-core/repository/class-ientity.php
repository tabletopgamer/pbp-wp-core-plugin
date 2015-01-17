<?php namespace PbP_Core\Repository;

/**
 * A interface describing a generic entity used in the plugins
 *
 * @author tabletopgamer
 */

interface IEntity {
	
	/**
	 * @return int
	 */
    function get_id();
	
	/**
	 * @return Entity_Type
	 */
    function  get_type();
}
