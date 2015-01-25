<?php
/**
 * @author tabletopgamer
 */

namespace PbP_Core\Templates;

use PbP_Core\Repository\IContent_Repository;

/**
 * Thp_Template_Engine is a custom templating engine, used for rendering .thp templates.
 *
 * The .thp file is php based, with minor improvements:
 * - all blocks between <? and ?> will be executed as php code
 * - all blocks like <?=EXPRESSION ?>will be converted to <?php echo EXPRESSION ?>
 * - all blocks <?# EXPRESSION ?> will be converted to <?php echo $model['EXPRESSION'] ?>
 *
 * Example:
 * <?=$model['value']?> renders the value of $model['value']
 * <?#value?> also renders the value of $model['value']
 *
 * @package Core
 */
class Thp_Template_Engine extends Template_Engine {

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
		$this->template_repository = $template_repository;
	}

	/**
	 * @param string $content
	 * @param array $model
	 *
	 * @return string
	 */
	protected function evaluate_content( $content, $model ) {
		ob_start();

		eval( '; ?>' . $content . '<?php ;' );

		return ob_get_clean();
	}

	/**
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function load_template( $template ) {
		$content = $this->template_repository->get_content( $template );

		return $this->parse( $content );
	}

	protected function parse( $content ) {

		$replacements = [
			[ 'pattern' => '~\<\?#\s*(.+?)\s*\?\>~', 'replace' => '<?php echo $model["$1"]; ?>' ],
			[ 'pattern' => '~\<\?=\s*(.+?)\s*\?\>~', 'replace' => '<?php echo $1; ?>' ],
			[ 'pattern' => '~\<\?\s*(?!php)(.+?)\s*\?\>~', 'replace' => '<?php $1?>' ],
		];
		foreach ( $replacements as $replace ) {

			$content = preg_replace( $replace['pattern'], $replace['replace'], $content );
		}

		return $content;
	}


}