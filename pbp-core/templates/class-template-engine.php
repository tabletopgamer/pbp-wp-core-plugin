<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 16:54
 */

namespace PbP_Core\Templates;


use PbP_Core\Templates\Sanitizers\IModel_Sanitizer;

abstract class Template_Engine implements ITemplate_Engine {

	/**
	 * @var array
	 */
	protected $template_files = array();
	/**
	 * @var IModel_Sanitizer
	 */
	private $sanitizer;


	public function __construct(IModel_Sanitizer $sanitizer){
		$this->sanitizer = $sanitizer;
	}

	/**
	 * @param $content string The template body. It should always be string.
	 * @param array $model The model used for populating the template. It is already sanitized at this point.
	 *
	 * @return string The content after evaluation. It should be in the ready for display state.
	 */
	protected abstract function evaluate_content( $content, $model );

	/***
	 * @param mixed $template The template identifier.
	 *
	 * @return string The template body. It is always a string
	 */
	protected abstract function load_template( $template );


	/**
	 * @param mixed $template The template unique identifier
	 * @param array $model The model used for populating the template.
	 *
	 * @return string
	 */
	public final function render( $template, array $model ) {

		$model = $this->sanitizer->sanitize( $model );

		$template = $this->get_template( $template );

		return $this->evaluate_content( $template, $model );

	}

	protected function get_template( $template_path ) {
		$key = hash( 'md5', $template_path );

		if ( ! $this->is_template_loaded( $key ) ) {
			$this->add_template( $key, $this->load_template( $template_path ) );
		}

		return $this->template_files[ $key ];
	}

	protected function is_template_loaded( $key ) {
		return isset( $this->template_files[ $key ] );
	}

	protected function add_template( $key, $template_content ) {
		$this->template_files[ $key ] = $template_content;
	}


}