<?php
use PbP_Core\Events\Event_Args;

/**
 * @coversDefaultClass PbP_Core\Events\Event_Args
 */
class Event_Args_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @covers ::EMPTY_OBJECT
	 * @test
	 */
	public function EMPTY_OBJECT_CalledTwice_WillReturnSameInstance() {
		$firstCallResult = Event_Args::EMPTY_OBJECT();
		$secondCallResult = Event_Args::EMPTY_OBJECT();

		$this->assertSame($firstCallResult, $secondCallResult);

	}

	/**
	 * @covers ::EMPTY_OBJECT
	 * @test
	 */
	public function EMPTY_OBJECT_ReturnsEmptyEventArgsObject() {
		$result = Event_Args::EMPTY_OBJECT();

		$this->assertEquals(new Event_Args(), $result);

	}
}
