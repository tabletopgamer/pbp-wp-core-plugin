<?php
use PbP_Core\DI\DI_Resolve_Param;
use PbP_Core\DI\Simple_DI;

/**
 * User: tabletopgamer
 * Date: 01.02.2015
 * Time: 18:25
 */

/**
 * @coversDefaultClass PbP_Core\DI\Simple_DI
 */
class Simple_DI_Tests extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Simple_DI
	 */
	private $sut;

	public function setUp() {
		$this->sut = new Simple_DI();
	}

	/**
	 * @covers ::register_instance
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage does not implement
	 */
	public function register_instance_WithInstanceThatDoesNotImplementRegisteredInterface_ThrowsException() {
		$obj = new Test_NoImpl();

		$this->sut->register_instance( 'ITest_Interface', $obj );
	}
	/**
	 * @covers ::register_instance
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage does not implement
	 */
	public function register_instance_WithInstanceThatDoesNotImplementRegisteredType_ThrowsException() {
		$obj = new Test_NoImpl();

		$this->sut->register_instance( 'Test_Impl', $obj );
	}

	/**
	 * @covers ::register_instance
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage does not exist
	 */
	public function register_instance_WithInvalidTBaseypeName_ThrowsException() {
		$obj = new Test_Impl();

		$this->sut->register_instance( 'Inexisting type', $obj);
	}

	/**
	 * @covers ::register_instance
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage 'non object type' is not an object
	 */
	public function register_instance_WithNonObjectParameter_ThrowsException() {

		$this->sut->register_instance( 'ITest_Interface', 'non object type' );
	}

	/**
	 * @covers ::register_type
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage 'Inexisting type' does not exist
	 */
	public function register_type_WithInvalidBaseTypeName_ThrowsException() {
		$this->sut->register_type( 'Inexisting type', 'Test_NoImpl');
	}

	/**
	 * @covers ::register_type
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage does not exist
	 */
	public function register_type_WithInvalidTypeName_ThrowsException() {
		$this->sut->register_type( 'ITest_Interface', 'Inexisting type');
	}

	/**
	 * @covers ::register_type
	 * @test
	 */
	public function register_type_WithValidTypes_DoesNotThrowException() {
		$this->sut->register_type( 'ITest_Interface', 'Test_Impl');
	}


	/**
	 * @covers ::resolve
	 * @test
	 */
	public function resolve_MultipleCallsForSameType_ReturnsSameInstanceBothTimes() {
		$this->sut->register_type( 'ITest_Interface', 'Test_Impl');

		$result_call_1 = $this->sut->resolve('ITest_Interface');
		$result_call_2 = $this->sut->resolve('ITest_Interface');

		$this->assertSame($result_call_1, $result_call_2);
	}

	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 */
	public function resolve_WithRegisteredInterfaceInstance_ReturnsTheInstance() {
		$obj = new Test_Impl();

		$this->sut->register_instance( 'ITest_Interface', $obj );

		$this->assertSame($obj, $this->sut->resolve('ITest_Interface'));
	}

	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 */
	public function resolve_WithRegisteredTypeInstance_ReturnsTheInstance() {
		$obj = new Test_Child_Impl();

		$this->sut->register_instance( 'Test_Impl', $obj );

		$this->assertSame($obj, $this->sut->resolve('Test_Impl'));
	}

	/**
	 * @covers ::resolve
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage is not registered
	 */
	public function resolve_WithNotRegisteredInstance_ThrowsException() {
		$this->sut->resolve('ITest_Interface');
	}

	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 */
	public function resolve_WithRegisteredType_ReturnsObjectOfThatType() {
		$this->sut->register_type( 'ITest_Interface', 'Test_Impl' );
		$result =$this->sut->resolve('ITest_Interface');

		$this->assertInstanceOf('ITest_Interface', $result);
	}

	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 */
	public function resolve_WithRegisteredTypeWithSimpleParams_ReturnsObjectOfThatType() {
		$this->sut->register_type( 'ITest_Interface', 'Test_Impl_With_Simple_Params',
			'param1Value', 'param2Value' );

		$result = $this->sut->resolve('ITest_Interface');

		$this->assertInstanceOf('ITest_Interface', $result);
	}


	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 * @expectedException \Exception
	 * @expectedExceptionMessage is not registered
	 */
	public function resolve_WithRegisteredType_WithUnregisteredDIParam_ThrowsException() {

		$this->sut->register_type( 'ITest_Interface', 'Test_Impl_With_DI_Params',
			new DI_Resolve_Param('ITest_Param_Interface'));

		$result = $this->sut->resolve('ITest_Interface');

		$this->assertInstanceOf('ITest_Interface', $result);
	}

	/**
	 * @covers ::resolve
	 * @covers ::get
	 * @test
	 */
	public function resolve_WithRegisteredType_WithRegisteredDIParam_ReturnsObjectOfThatType() {

		$this->sut->register_type('ITest_Param_Interface', 'Test_Param_Impl');

		$this->sut->register_type( 'ITest_Interface', 'Test_Impl_With_DI_Params',
			new DI_Resolve_Param('ITest_Param_Interface'));

		$result = $this->sut->resolve('ITest_Interface');

		$this->assertInstanceOf('ITest_Interface', $result);
	}

}


class Test_NoImpl {
	function do_something() {
	}
}

interface ITest_Interface {
	function do_something();
}

class Test_Impl implements ITest_Interface {
	function do_something() {
	}
}

class Test_Child_Impl extends Test_Impl {
	function do_something() {
	}
}

class Test_Impl_With_Simple_Params implements ITest_Interface {
	public function __construct($param1, $param2){

	}

	function do_something() {
	}
}

interface ITest_Param_Interface {
}

class Test_Param_Impl implements  ITest_Param_Interface {
}

class Test_Impl_With_DI_Params implements ITest_Interface {
	public function __construct(ITest_Param_Interface $param){

	}

	function do_something() {
	}
}


