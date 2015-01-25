<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 11:10
 */

use PbP_Core\Events\Event_Args;

/**
 * @coversDefaultClass PbP_Core\Events\Event_Args
 */
class Event_Args_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @covers ::NULL_OBJECT
	 * @test
	 */
	public function EMPTY_OBJECT_CalledTwice_WillReturnSameInstance() {
		$firstCallResult = Event_Args::EMPTY_OBJECT();
		$secondCallResult = Event_Args::EMPTY_OBJECT();

		$this->assertSame($firstCallResult, $secondCallResult);

	}

	/**
	 * @covers ::NULL_OBJECT
	 * @test
	 */
	public function EMPTY_OBJECT_ReturnsEmptyEventArgsObject() {
		$result = Event_Args::EMPTY_OBJECT();

		$this->assertEquals(new Event_Args(), $result);

	}
}
