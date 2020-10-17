<?php


namespace Nekrida\Events;


interface EventSubscriberInterface
{
	/**
	 * Sets the events the subscriber subscribes to
	 * @param EventDispatcherInterface $eventDispatcher
	 * @return mixed
	 */
	public function listen(EventDispatcherInterface $eventDispatcher);
}