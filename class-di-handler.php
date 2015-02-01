<?php
use PbP_Core\DI\DI_Resolve_Param;
use PbP_Core\DI\Simple_DI;

/**
 * User: tabletopgamer
 * Date: 01.02.2015
 * Time: 20:50
 */
class DI_Handler {

	public static function create_di() {
		$di = new Simple_DI();

		$di->register_type(
			'PbP_Core\Templates\Sanitizers\IModel_Sanitizer',
			'PbP_Core\Templates\Sanitizers\Simple_Model_Sanitizer' );

		$di->register_type(
			'PbP_Core\Repository\IContent_Repository',
			'PbP_Core\Repository\File_Repository',
				PBP_PLUGIN_BASE_PATH );

		$di->register_type(
			'PbP_Core\Templates\ITemplate_Engine',
			'PbP_Core\Templates\Thp_Template_Engine',
				new DI_Resolve_Param( 'PbP_Core\Repository\IContent_Repository' ),
				new DI_Resolve_Param( 'PbP_Core\Templates\Sanitizers\IModel_Sanitizer' ) );

		return $di;
	}
}