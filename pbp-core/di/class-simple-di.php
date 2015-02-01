<?php
/**
 * User: tabletopgamer
 * Date: 01.02.2015
 * Time: 18:15
 */

namespace PbP_Core\DI;

/**
 * Class SimpleDI
 * This will serve as DI container replacement, as it can register class elements and
 *
 * @package PbP_Core
 */
class Simple_DI implements ISimple_Dependency_Injection {
	/**
	 * @var array
	 */
	private $instances = array();
	private $types = array();

	public function __construct() {

	}

	/**
	 * @param string $base_type_name
	 * @param string $type_name
	 *
	 * @return mixed
	 */
	public function register_type( $base_type_name, $type_name ) {
		$this->throw_exception_if_type_does_not_exist( $base_type_name );
		$this->throw_exception_if_type_does_not_exist( $type_name );

		$arguments = array_slice(func_get_args(), 2);

		$this->add_type( $base_type_name, $type_name, $arguments );
	}
	/**
	 * @param string $base_type_name
	 * @param object $instance
	 */
	public function register_instance( $base_type_name, $instance ) {
		$this->throw_exception_if_not_object( $instance );
		$this->throw_exception_if_type_does_not_exist( $base_type_name );
		$this->throw_exception_if_does_not_implement_type( $base_type_name, $instance);

		$this->add_instance($base_type_name, $instance);
	}

	public function resolve( $base_type_name ) {
		$result = $this->get_instance( $base_type_name );

		if ($result == null){
			$type = $this->get_type($base_type_name);

			if ($type != null) {
				$class_name = $type['class'];
				$args = $type['args'];

				$resolved_args = $this->resolve_args($args);

				$ref = new \ReflectionClass($class_name );
				$result = $ref->newInstanceArgs($resolved_args);

				$this->add_instance($base_type_name, $result);
			}
		}

		if ($result == null)
			throw new \InvalidArgumentException( "The '$base_type_name' is not registered in this DI.'" );

		return $result;
	}

	private function get_key( $name ) {
		return strtolower( $name );
	}

	private function add_instance($base_type_name, $instance){
		$key = $this->get_key( $base_type_name );
		$this->instances[ $key ] = $instance;
	}

	private function get_instance($base_type_name){
		$key = $this->get_key( $base_type_name );

		return $this->try_get_value($key, $this->instances);
	}

	private function add_type($base_type_name, $type_name, $arguments){
		$key = $this->get_key( $base_type_name );

		$this->types[$key] = array( 'class' => $type_name, 'args'=>$arguments );
	}

	private function get_type($base_type_name){
		$key = $this->get_key( $base_type_name );

		return $this->try_get_value($key, $this->types);
	}


	private function try_get_value($key, array $array, $default=null){
		return isset($array[$key]) ? $array[$key] : $default;
	}

	/**
	 * @param $type_name
	 * @param $instance
	 */
	public function throw_exception_if_not_object( $instance ) {
		if ( ! is_object( $instance ) ) {
			throw new \InvalidArgumentException( "Parameter '$instance' is not an object." );
		}
	}

	/**
	 * @param $type_name
	 * @param $instance
	 * @param $class_name
	 */
	private function throw_exception_if_does_not_implement_type( $type_name, $instance) {
		$class_name = get_class( $instance );

		$interfaces = array_values(class_implements( $instance ));
		$base_type = array_values(class_parents($instance));

		if ( ! in_array( $type_name,$interfaces ) && !in_array($type_name, $base_type) ) {
			throw new \InvalidArgumentException( "Type '$class_name; does not implement '$type_name'." );
		}
	}

	/**
	 * @param $base_type_name
	 */
	private function throw_exception_if_type_does_not_exist( $base_type_name ) {
		if ( ! class_exists( $base_type_name ) && ! interface_exists( $base_type_name ) ) {
			throw new \InvalidArgumentException( "Type '$base_type_name' does not exist." );
		}
	}

	private function resolve_args( $args ) {
		$result = array();

		foreach ($args as $arg){
			$param = $arg;
			if ( is_object($arg) && get_class($arg) == 'PbP_Core\DI\DI_Resolve_Param'){
				$param = $this->resolve($arg->get_type_name());
			}
			$result[] = $param;
		}

		return $result;
	}

}