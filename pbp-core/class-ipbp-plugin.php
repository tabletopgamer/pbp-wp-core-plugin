<?php
/**
 * User: tabletopgamer
 * Date: 21.01.2015
 * Time: 22:12
 */

namespace PbP_Core;


use PbP_WP\Custom_Posts\ICustom_Post_Type;

interface IPbP_Plugin {

	/**
	 * @return Included_File[]
	 */
	function get_included_scripts();

	/**
	 * @return Included_File[]
	 */
	function get_included_styles();


	/**
	 * @return ICustom_Post_Type[]
	 */
	function get_custom_post_types();

}