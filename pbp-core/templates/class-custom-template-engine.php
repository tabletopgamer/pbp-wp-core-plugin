<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 12:43
 */

namespace PbP_Core\Templates;

use PbP_Core\Repository\IContent_Repository;

class Custom_Template_Engine implements ITemplate_Engine {

	private $template_files;

	/**
	 * @var IContent_Repository
	 */
	private $template_repository;

	/**
	 * @param IContent_Repository $template_repository
	 *
	 * @param string $base_path
	 */
	public function __construct( IContent_Repository $template_repository ) {
		$this->template_files      = array();
		$this->template_repository = $template_repository;
	}

	/**
	 * @param string $template_path
	 * @param array $model
	 *
	 * @return string
	 */
	public function render( $template_path, $model ) {

		$template = $this->get_template( $template_path );

		$this->sanitize_model( $model );

		return $this->evaluate_template( $template, $model );

	}

	private function get_template( $template_path ) {
		$key = hash( 'md5', $template_path );

		if ( ! $this->is_template_loaded( $key ) ) {
			$this->load_template( $key, $template_path );
		}

		return $this->template_files[ $key ];
	}

	private function is_template_loaded( $key ) {
		return isset( $this->template_files[ $key ] );
	}

	private function load_template( $key, $template_path ) {
		$template_content = $this->template_repository->get_content( $template_path );
		$template_content = $this->parse_template( $template_content );

		$this->template_files[ $key ] = $template_content;
	}

	private static function evaluate_template( $template, $model ) {
		ob_start();

		eval( '; ?>' . $template . '<?php ;' );

		return ob_get_clean();
	}

	private static function sanitize_model( $model ) {
		array_walk_recursive( $model, function ( &$item, $key ) {
			$item = htmlspecialchars( $item, ENT_QUOTES );
		} );
	}

	private static function parse_template( $template ) {

		$replacements = [
			[ 'pattern' => '~\<\?#\s*(.+?)\s*\?\>~', 'replace' => '<?php echo $model["$1"]; ?>' ],
			[ 'pattern' => '~\<\?=\s*(.+?)\s*\?\>~', 'replace' => '<?php echo $1; ?>' ],
			[ 'pattern' => '~\<\?\s*(?!php)(.+?)\s*\?\>~', 'replace' => '<?php $1?>' ],
		];
		foreach ( $replacements as $replace ) {
			var_dump( $template );

			$template = preg_replace( $replace['pattern'], $replace['replace'], $template );
		}

		return $template;
	}


}