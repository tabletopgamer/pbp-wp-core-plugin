<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 10:45
 */

namespace PbP_Core\Events;


interface IEvent_Engine {

	/**
	 * Registers a callback with a specific $event_name
	 *
	 * @param Event $event The name of the event this action will be linked to
	 * @param callable $callback The function that will be called when the event with $event_name will be triggered
	 */
	function attach( $event, callable $callback );

	/**
	 * Triggers all the events registered for the $event_name
	 *
	 * @param string $event_name
	 * @param Event_Args $event_args
	 */
	function trigger( $event_name, Event_Args $event_args = null );
}