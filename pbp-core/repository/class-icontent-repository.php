<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 14:13
 */

namespace PbP_Core\Repository;


interface IContent_Repository {

	/**
	 * @param string $content_identifier
	 *
	 * @return string
	 */
	public function get_content($content_identifier);
}