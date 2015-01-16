<?php
/**
 * User: tabletopgamer
 * Date: 14.01.2015
 * Time: 05:34
 */

namespace tests\unit;

use PbP_Core\Interfaces\Enum;


class EnumTests extends \PHPUnit_Framework_TestCase {

	/**
	 * @var EnumA
	 */
	private $sut;

	public function setUp() {
		// reset all properties to null values
		EnumA::set_PROP_01( null );
		EnumA::set_PROP_02( null );
		EnumA::set_PROP_03( null );
		EnumA::tearDown();

		EnumB::set_PROP_01( null );
		EnumB::tearDown();
	}

	/**
	 * @covers Enum
	 */
	public function test_Enum_CreatedThroughStaticMethod_SetsCorrectValueForThatInstance() {
		EnumA::set_PROP_01( "iron-man" );

		$result = EnumA::PROP_01()->get_value();

		$this->assertEquals( "iron-man", $result );
	}


	public function test_Enum_WhenConvertedToString_ReturnsThatInstanceValue() {
		EnumA::set_PROP_01( "life-42" );

		$sut = EnumA::PROP_01();

		$this->assertEquals( "life-42", (string) $sut );
	}

	public function test_Enum_CreatedThroughStaticMethod_WithUnDefinedPropertyName_ThrowsException() {

		$this->setExpectedException( 'InvalidArgumentException', 'No enum defined for' );

		EnumA::PROP_XXX();
	}


	public function test_EqualityComparatorsOnSameEnum_AndSameProperty_ReturnTrue() {
		EnumA::set_PROP_01( 'the-same' );

		$this->assertTrue( EnumA::PROP_01() == EnumA::PROP_01() );
		$this->assertEquals( EnumA::PROP_01(), EnumA::PROP_01() );
	}

	public function test_EqualityComparatorsOnSameEnum_AndDifferentProperties_ReturnFalse() {
		EnumA::set_PROP_01( 'primary' );
		EnumA::set_PROP_02( 'secondary' );

		$this->assertFalse( EnumA::PROP_01() == EnumA::PROP_02() );
		$this->assertNotEquals( EnumA::PROP_01(), EnumA::PROP_02() );
	}

	public function test_TwoEnums_WithSamePropertyName_ButDifferentValue_AreNotEqual() {
		EnumA::set_PROP_01( 'aquatic' );
		EnumB::set_PROP_01( 'circus' );

		$this->assertTrue( EnumA::PROP_01() != EnumB::PROP_01() );
	}

	public function test_TwoEnums_WithSamePropertyName_AndSameValue_AreNotEqual() {
		EnumA::set_PROP_01( 'green' );
		EnumB::set_PROP_01( 'green' );

		$this->assertTrue( EnumA::PROP_01() != EnumB::PROP_01() );
	}

	public function test_TwoEnums_WithDifferentPropertyName_AndSameValue_AreNotEqual() {
		EnumA::set_PROP_02( 'brown' );
		EnumB::set_PROP_01( 'brown' );

		$this->assertTrue( EnumA::PROP_02() != EnumB::PROP_01() );
	}

	public function test_Enum_WithPropertyWithoutValue_SetsThePropertyNameAsValue() {
		$result = EnumB::PROP_WITHOUT_VALUE();

		$this->assertEquals( "PROP_WITHOUT_VALUE", $result->get_value() );
	}

	public function test_GetFromValue_CalledWithExistingPropertyWithValue_ReturnsCorrectEnumInstance() {

		$value = "hey-joe";
		EnumA::set_PROP_01( $value );

		$result = EnumA::get_from_value( $value );

		$this->assertEquals( EnumA::PROP_01(), $result );
	}


	public function test_GetFromValue_CalledWithExistingPropertyWithoutValue_ReturnsCorrectEnumInstance() {

		$result = EnumB::get_from_value('PROP_WITHOUT_VALUE');

		$this->assertEquals( EnumB::PROP_WITHOUT_VALUE(), $result );
	}

	public function test_GetFromValue_FallbackToPropertyName_IfNoPropertyWithThatValueExists() {
		EnumA::set_PROP_01("my_value");

		$result = EnumA::get_from_value("PROP_01");

		$this->assertEquals( EnumA::PROP_01(), $result );
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
	protected static $PROP_01 = "a_test";
	protected static $PROP_02 = "b_test";
	protected static $PROP_03 = "a_other_test";

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

	public static function tearDown() {
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
	protected static $PROP_01 = "a_other_test";
	protected static $PROP_WITHOUT_VALUE;

	/**
	 * @param string $PROP_01
	 */
	public static function set_PROP_01( $PROP_01 ) {
		self::$PROP_01 = $PROP_01;
	}

	public static function tearDown() {
		parent::reset_instance_cache();
	}
}
