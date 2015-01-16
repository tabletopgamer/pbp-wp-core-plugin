<?php namespace PbP_Core\Interfaces;
/**
 * Class Enum
 *
 * Provides basic support for implementing Enum like structures.
 * Usage Example:
 * <code>
 * // Extend the class and define static protected methods for all enum types.
 *
 * class AwesomeEnum extends Enum {
 *    protected static $PROP_01 = "someValue";
 *    protected static $PROP_02 = "someOtherValue";
 *    protected static $PROP_03;    // this property can be missing, and will have "PROP_03" value
 * }
 *
 * // Use it like:
 *
 *  $myEnum   = AwesomeEnum::PROP_01();
 *  $itIsTrue = AwesomeEnum::get_from_value("someOtherValue") == AwesomeEnum::$PROP_02
 * </code>
 *
 * @package PbP_Core
 * User: tabletopgamer
 * Date: 14.01.2015
 * Time: 05:29
 */


abstract class Enum {
	/**
	 * @var array
	 */
	private static $defined_enums;
	/**
	 * @var string
	 */
	protected $value;

	private function __construct( $value ) {
		$this->value = $value;
	}

	/**
	 * @param string $name
	 * @param array $arguments
	 *
	 * @return Enum The Enum instance with appropriate value set
	 * @throws \BadMethodCallException
	 */
	public static function __callStatic( $name, $arguments ) {
		$property   = null;
		$class      = get_called_class();
		$reflection = new \ReflectionClass( $class );

		try {
			$property = $reflection->getProperty( $name );

		} catch ( \Exception $exception ) {
			throw new \InvalidArgumentException( "No enum defined for '$name' class '$class'" );
		}

		if ( ! $property->isStatic() || ! $property->isProtected() ) {
			throw new \InvalidArgumentException( "No enum defined for '$name' class '$class'" );
		}

		return self::get_enum_instance_and_cache_it( $class, $name );
	}

	/**
	 * @param mixed $value One of the values from the enum
	 *
	 * @return mixed
	 */
	public static function get_from_value( $value ) {

		$class      = get_called_class();
		$properties = get_class_vars( $class );

		$name = array_search( $value, $properties, true );

		// fallback to the property name if no value was found
		if ( $name === false ) {
			$name = $value;
		}

		return self::get_enum_instance_and_cache_it( get_called_class(), $name );
	}

	/**
	 * @return mixed the actual value of the enum
	 */
	public function get_value() {
		return $this->value;
	}

	public function __toString() {
		return (string) $this->get_value();
	}

	/**
	 * Resets the Enum Instance Cache.
	 * Should never be called, except maybe unit tests!
	 */
	protected static function reset_instance_cache() {
		self:: $defined_enums = null;
	}

	private static function get_enum_instance_and_cache_it( $class, $name ) {
		if ( ! isset( self::$defined_enums[ $class ][ $name ] ) ) {
			if ( ! is_array( self::$defined_enums ) ) {
				self::$defined_enums = array();
			}

			if ( ! isset( self::$defined_enums[ $class ] ) ) {
				self::$defined_enums[ $class ] = array();
			}

			if ( ! isset( self::$defined_enums[ $class ][ $name ] ) ) {

				self::$defined_enums[ $class ][ $name ] = new $class( ( $class::$$name ) ? $class::$$name : $name );
			}
		}

		return self::$defined_enums[ $class ][ $name ];
	}


}

