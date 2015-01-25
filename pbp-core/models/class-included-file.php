<?php
/**
 * User: tabletopgamer
 * Date: 21.01.2015
 * Time: 22:15
 */

namespace PbP_Core\Models;


class Included_File {
	/**
	 * @var string
	 */
	private $script_name;
	/**
	 * @var string
	 */
	private $file_name;

	/**
	 * @param string $script_name
	 * @param string $file_name
	 */
	public function __construct( $script_name, $file_name ) {

		$this->script_name = $script_name;
		$this->file_name   = $file_name;
	}

	/**
	 * @return string
	 */
	public function get_script_name() {
		return $this->script_name;
	}

	/**
	 * @param string $script_name
	 */
	public function set_script_name( $script_name ) {
		$this->script_name = $script_name;
	}

	/**
	 * @return string
	 */
	public function get_file_name() {
		return $this->file_name;
	}

	/**
	 * @param string $file_name
	 */
	public function set_file_name( $file_name ) {
		$this->file_name = $file_name;
	}

}