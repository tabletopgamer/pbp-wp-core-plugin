<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 14:06
 */

namespace PbP_Core\Repository;


class File_Repository implements IContent_Repository {

	/**
	 * @var string
	 */
	private $base_path;

	/**
	 * @param $base_path
	 */
	public function __construct( $base_path ) {
		if ( ! path_is_absolute( $base_path ) ) {
			throw new \InvalidArgumentException( "Argument 'base_path' must be absolute path. (base_path: $base_path)" );
		}

		$this->base_path = $base_path;
	}

	/**
	 * @param string $content_identifier
	 *
	 * @return string
	 */
	public function get_content( $content_identifier ) {
		if (!path_is_absolute($content_identifier))
			$content_identifier =  path_join($this->base_path, $content_identifier);

		return file_get_contents( $content_identifier );
	}
}