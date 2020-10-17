<?php


namespace Nekrida\Events;

/**
 * Interface EventDispatcherInterface
 * @package Nekrida\Events
 */
interface EventDispatcherInterface
{
	/**
	 * Adds listener to the event
	 * @param string $event
	 * @param string $listener Listener class name or callable
	 * @param string $method Listener method unless it is provided in $listener
	 * @return mixed
	 */
	public function listen($event, $listener, $method = "");

	/**
	 * Dispatches the event
	 * @param $event
	 * @return mixed
	 */
	public function dispatch($event);
}