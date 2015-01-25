<?php
/**
 * User: tabletopgamer
 * Date: 14.01.2015
 * Time: 05:34
 */

use PbP_Core\Util\Enum;

/**
 * @coversDefaultClass PbP_Core\Util\Enum
 */
class Enum_Tests extends \PHPUnit_Framework_TestCase {

	public function setUp() {

		// reset all properties to null values
		EnumA::set_PROP_01( null );
		EnumA::set_PROP_02( null );
		EnumA::set_PROP_03( null );
		EnumA::reset_instance_cache();

		EnumB::set_PROP_01( null );
		EnumB::reset_instance_cache();
	}

	/**
	 * @covers ::get_value
	 */
	public function getValue_CreatedThroughStaticMethod_SetsCorrectValueForThatInstance() {
		EnumA::set_PROP_01( "iron-man" );

		$result = EnumA::PROP_01()->get_value();

		$this->assertEquals( "iron-man", $result );
	}

	/**
	 * @covers ::__toString
	 */
	public function coString_WhenConvertedToString_ReturnsThatInstanceValue() {
		EnumA::set_PROP_01( "life-42" );

		$sut = EnumA::PROP_01();

		$this->assertEquals( "life-42", (string) $sut );
	}

	/**
	 * @covers ::__callStatic
	 * @expectedException InvalidArgumentException
	 */
	public function callStatic_WithUnDefinedPropertyName_ThrowsException() {

		$this->setExpectedException( 'InvalidArgumentException', 'No enum defined for' );

		EnumA::PROP_XXX();
	}

	/**
	 * @covers ::__callStatic
	 */
	public function callStatic_WithPublicPropertyName_ThrowsException() {

		$this->setExpectedException( 'InvalidArgumentException', 'No enum defined for' );

		EnumA::PUBLIC_STATIC_PROP();
	}

	/**
	 * @covers ::__callStatic
	 * @expectedException InvalidArgumentException
	 */
	public function callStatic_WithProtectedNonStaticName_ThrowsException() {

		$this->setExpectedException( 'InvalidArgumentException', 'No enum defined for' );

		EnumA::PROTECTED_NOT_STATIC();
	}

	/**
	 * @covers ::__callStatic
	 */
	public function equalityComparators_OnSameEnum_AndSameProperty_ReturnTrue() {
		EnumA::set_PROP_01( 'the-same' );

		$this->assertTrue( EnumA::PROP_01() == EnumA::PROP_01() );
		$this->assertEquals( EnumA::PROP_01(), EnumA::PROP_01() );
	}

	/**
	 * @test
	 * @covers ::__callStatic
	 */
	public function equalityComparators_OnSameEnum_AndDifferentProperties_ReturnFalse() {
		EnumA::set_PROP_01( 'primary' );
		EnumA::set_PROP_02( 'secondary' );

		$this->assertFalse( EnumA::PROP_01() == EnumA::PROP_02() );
		$this->assertNotEquals( EnumA::PROP_01(), EnumA::PROP_02() );
	}

	/**
	 * @test
	 * @covers ::__callStatic
	 */
	public function twoEnums_WithSamePropertyNames_ButDifferentValues_AreNotEqual() {
		EnumA::set_PROP_01( 'aquatic' );
		EnumB::set_PROP_01( 'circus' );

		$this->assertTrue( EnumA::PROP_01() != EnumB::PROP_01() );
	}

	/**
	 * @test
	 * @covers ::__callStatic
	 */
	public function twoEnums_WithSamePropertyNames_AndSameValues_AreNotEqual() {
		EnumA::set_PROP_01( 'green' );
		EnumB::set_PROP_01( 'green' );

		$this->assertTrue( EnumA::PROP_01() != EnumB::PROP_01() );
	}

	/**
	 * @test
	 * @covers ::__callStatic
	 */
	public function twoEnums_WithDifferentPropertyNames_ButWithSameValues_AreNotEqual() {
		EnumA::set_PROP_02( 'brown' );
		EnumB::set_PROP_01( 'brown' );

		$this->assertTrue( EnumA::PROP_02() != EnumB::PROP_01() );
	}

	/**
	 * @test
	 * @covers ::get_value
	 */
	public function callStatic_WithPropertyWithoutValue_SetsThePropertyNameAsValue() {
		$result = EnumB::PROP_WITHOUT_VALUE();

		$this->assertEquals( 'PROP_WITHOUT_VALUE', $result->get_value() );
	}

	/**
	 * @test
	 * @covers ::get_from_value
	 */
	public function getFromValue_CalledWithExistingPropertyWithValue_ReturnsCorrectEnumInstance() {

		$value = 'hey-joe';
		EnumA::set_PROP_01( $value );

		$result = EnumA::get_from_value( $value );

		$this->assertEquals( EnumA::PROP_01(), $result );
	}

	/**
	 * @test
	 * @covers ::get_from_value
	 */
	public function getFromValue_CalledWithExistingPropertyWithoutValue_ReturnsCorrectEnumInstance() {

		$result = EnumB::get_from_value( 'PROP_WITHOUT_VALUE' );

		$this->assertEquals( EnumB::PROP_WITHOUT_VALUE(), $result );
	}

	/**
	 * @test
	 * @covers ::get_from_value
	 */
	public function getFromValue_FallbackToPropertyName_IfNoPropertyWithThatValueExists() {
		EnumA::set_PROP_01( 'my_value' );

		$result = EnumA::get_from_value( "PROP_01" );

		$this->assertEquals( EnumA::PROP_01(), $result );
	}

	/**
	 * @test
	 * @covers ::__construct
	 * @covers ::get_enum_instance_and_cache_it
	 */
	public function callStatic_ConsecutiveSettingOfSameProperty_DoesNotUpdateValues() {
		EnumA::set_PROP_01( 'value 1' );
		$resultFromFirstCall = EnumA::PROP_01();

		EnumA::set_PROP_01( 'value 2' );
		$resultFromSecondCall = EnumA::PROP_01();

		$this->assertEquals( 'value 1', $resultFromFirstCall );
		$this->assertEquals( 'value 1', $resultFromSecondCall );

	}

	/**
	 * @test
	 * @covers ::reset_instance_cache
	 */
	public function resetInstanceCache_ClearsInstanceCache() {
		EnumA::set_PROP_01( 'value 1' );
		$resultFromFirstCall = EnumA::PROP_01();

		EnumA::reset_instance_cache();

		EnumA::set_PROP_01( 'value 2' );
		$resultFromSecondCall = EnumA::PROP_01();

		$this->assertEquals( 'value 1', $resultFromFirstCall );
		$this->assertEquals( 'value 2', $resultFromSecondCall );

	}
}


/**
 * Test Class Fixture
 *
 * @method static EnumA PROP_01()
 * @method static EnumA PROP_02()
 * @method static EnumA PROP_03()
 */
class EnumA extends Enum {
	protected static $PROP_01 = 'a_test';
	protected static $PROP_02 = 'b_test';
	protected static $PROP_03 = 'a_other_test';

	/**
	 * @param string $PROP_01
	 */
	public static function set_PROP_01( $PROP_01 ) {
		self::$PROP_01 = $PROP_01;
	}

	/**
	 * @param string $PROP_02
	 */
	public static function set_PROP_02( $PROP_02 ) {
		self::$PROP_02 = $PROP_02;
	}

	/**
	 * @param string $PROP_03
	 */
	public static function set_PROP_03( $PROP_03 ) {
		self::$PROP_03 = $PROP_03;
	}

	public static function reset_instance_cache() {
		parent::reset_instance_cache();
	}

}

/**
 * Test Class Fixture
 *
 * @method static EnumB PROP_01()
 * @method static EnumB PROP_WITHOUT_VALUE()
 */
class EnumB extends Enum {
	protected static $PROP_01 = 'a_other_test';
	protected static $PROP_WITHOUT_VALUE;
	public static $PUBLIC_STATIC_PROP;
	protected $PROTECTED_NOT_STATIC;

	/**
	 * @param string $PROP_01
	 */
	public static function set_PROP_01( $PROP_01 ) {
		self::$PROP_01 = $PROP_01;
	}

	public static function reset_instance_cache() {
		parent::reset_instance_cache();
	}
}
