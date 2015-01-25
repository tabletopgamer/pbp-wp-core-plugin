<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 10:49
 */

namespace PbP_Core\Events;


class Event_Engine implements IEvent_Engine {

	/**
	 * @var array
	 */
	protected $events;

	public function __construct() {
		$this->events = array();
	}

	/**
	 * Registers a callback with a specific $event_name
	 *
	 * @param string $event_name The name of the event this action will be linked to
	 * @param callable $callback The function that will be called when the event with $event_name will be triggered
	 *
	 * @return void
	 */
	function attach( $event_name, callable $callback ) {

		if ( ! $this->has_listeners($event_name) ) {
			$this->events[ $event_name ] = array();
		}

		$this->events[ $event_name ][] = $callback;
	}

	/**
	 * Triggers all the events registered for the $event_name
	 *
	 * @param string $event_name
	 *
	 * @return void
	 */
	function trigger( $event_name, Event_Args $event_args = null ) {

		if ( $this->has_listeners($event_name) ) {
			if ( $event_args === null ) {
				$event_args = Event_Args::EMPTY_OBJECT();
			}

			foreach ( $this->events[ $event_name ] as $callback ) {
				$callback( $event_name, $event_args );
			}
		}
	}

	private function has_listeners ( $event_name ){
		return isset( $this->events[ $event_name ] );
	}
}