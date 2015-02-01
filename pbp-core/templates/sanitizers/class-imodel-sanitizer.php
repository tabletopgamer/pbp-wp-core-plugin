<?php
/**
 * User: tabletopgamer
 * Date: 28.01.2015
 * Time: 09:01
 */

namespace PbP_Core\Templates\Sanitizers;


interface IModel_Sanitizer {

	/**
	 * @param array $model The model that needs sanitizing
	 *
	 * @return array The sanitized model
	 */
	function sanitize(array $model);
}