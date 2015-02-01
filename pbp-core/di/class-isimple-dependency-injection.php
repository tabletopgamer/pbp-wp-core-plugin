<?php
/**
 * User: tabletopgamer
 * Date: 01.02.2015
 * Time: 19:15
 */
namespace PbP_Core\DI;


/**
 * Interface ISimple_Dependency_Injection
 * This will serve as DI container replacement, as it can register class elements and
 *
 * @package PbP_Core
 */
interface ISimple_Dependency_Injection {
	/**
	 * @param string $base_type_name
	 * @param object $instance
	 */
	public function register_instance( $base_type_name, $instance );

	/**
	 * @param string $base_type_name
	 * @param string $type_name
	 *
	 * @return mixed
	 */
	public function register_type($base_type_name, $type_name);

	/**
	 * @param string $type_name
	 *
	 * @return object
	 */
	public function resolve( $type_name );

}