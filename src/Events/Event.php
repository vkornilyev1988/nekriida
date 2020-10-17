<?php
namespace Nekrida\Events;

/**
 * Class Event
 * @package Nekrida\Events
 */
class Event
{
	/** @var string $name Name of the event */
	protected static $name;

	protected $propagationActive = true;

	public function stopPropagation() {
		$this->propagationActive = false;
	}

	public function isPropagationActive() {
		return $this->propagationActive;
	}

	/**
	 * Returns event name.
	 * Event name is either set in the static::$name variable or is taken from the class name itself (ignoring the word Event at the end)
	 * @example OrderShippedEvent -> 'order.shipped'
	 * @return string|void
	 */
	public function getName() {
		if (static::$name)
			return static::$name;
		$lastSlash = strrpos(static::class,'\\') ?: 0;
		$name = str_replace('Event','',substr(static::class,$lastSlash));

		return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '.$0', $name)), '.');

	}

	public static function emit(Event $event) {
		EventDispatcher::getInstance()->dispatch($event);
	}
}