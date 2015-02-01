<?php
/**
 * User: tabletopgamer
 * Date: 28.01.2015
 * Time: 09:02
 */

namespace PbP_Core\Templates\Sanitizers;


class Simple_Model_Sanitizer implements IModel_Sanitizer{

	/**
	 * @param array $model The model that needs sanitizing
	 *
	 * @return array The sanitized model
	 */
	function sanitize( array $model ) {
		array_walk_recursive( $model, function ( &$item, $key ) {
			$item = htmlspecialchars( $item, ENT_QUOTES );
		} );

		return $model;
	}
}