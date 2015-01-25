<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 15:20
 */
namespace PbP_Core\Templates;

interface ITemplate_Engine {

	/**
	 * @param string $template_path The relative path to the template file
	 * @param array $model The model for populating template variables.
	 *
	 * @return mixed
	 */
	public function render( $template_path, $model );
}