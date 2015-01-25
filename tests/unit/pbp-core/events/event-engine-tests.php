<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 11:10
 */

use PbP_Core\Events\Event_Engine;

/**
 * @coversDefaultClass PbP_Core\Events\Event_Engine
 */
class Event_Engine_Tests extends PHPUnit_Framework_TestCase {

	/**
	 * @covers ::attach
	 * @test
	 */
	public function attach_withOneEventAndOneCallback_RegistersOneCallback() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'test_callback', $this->never() ) );

		$this->assertCount(1, $sut->get_listeners_for($event_name));
	}

	/**
	 * @covers ::attach
	 * @test
	 */
	public function attach_withOneEventAndTwoCallbacks_RegistersTwoCallbacks() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'test_callback_1', $this->never() ) );
		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'test_callback_2', $this->never() ) );

		$this->assertCount(2, $sut->get_listeners_for($event_name));
	}

	/**
	 * @covers ::attach
	 * @test
	 */
	public function attach_withTwoEventsWithDifferentCallbacks_RegistersCorrectCallbackPerEvent() {
		$sut        = $this->get_sut();

		$sut->attach( 'test-event-1', $this->create_mock_callback_with_expectation( 'test_callback_1', $this->never() ) );
		$sut->attach( 'test-event-2', $this->create_mock_callback_with_expectation( 'test_callback_2', $this->never() ) );

		$this->assertCount(1, $sut->get_listeners_for('test-event-1'));
		$this->assertCount(1, $sut->get_listeners_for('test-event-2'));
	}

	/**
	 * @covers ::trigger
	 * @test
	 */
	public function trigger_withNoRegisteredEvent_DoesNotThrowException() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->trigger( $event_name );
	}

	/**
	 * @covers ::trigger
	 * @test
	 */
	public function trigger_withOneRegisteredEvent_CallsThatEventCallbackOnce() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'test_callback', $this->once() ) );

		$sut->trigger( $event_name );

	}

	/**
	 * @covers ::trigger
	 * @test
	 */
	public function trigger_withOneRegisteredEventAndMultipleCallbacks_CallsAllEventCallbacksOnce() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'on_test_event_1', $this->once() ) );
		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'on_test_event_2', $this->once() ) );

		$sut->trigger( $event_name );
	}


	/**
	 * @covers ::trigger
	 * @test
	 */
	public function trigger_withTwoRegisteredEvents_CallsOnlyThatEventCallbacks() {
		$event_name = 'test-event';
		$sut        = $this->get_sut();

		$sut->attach( $event_name, $this->create_mock_callback_with_expectation( 'on_test_event', $this->once() ) );
		$sut->attach( 'some-event', $this->create_mock_callback_with_expectation( 'on_other_event', $this->never() ) );

		$sut->trigger( $event_name );
	}

	private function create_mock_callback_with_expectation( $method_name, $times ) {
		$mockEventHandler = $this->getMock( 'Test' . $method_name, array( $method_name ) );
		$mockEventHandler->expects( $times )->method( $method_name );

		return array( $mockEventHandler, $method_name );
	}

	private function get_sut() {
		return new Event_Engine_Test();
	}

}


/***
 * Class Event_Engine_Test
 * Helper class for testing Event_Engine.
 * It gives access to protected properties for testing purposes only.
 */
class Event_Engine_Test extends Event_Engine{

	public function get_listeners_for ( $event_name ) {
		return isset( $this->events[$event_name] ) ? $this->events[$event_name] : array();
	}
}
