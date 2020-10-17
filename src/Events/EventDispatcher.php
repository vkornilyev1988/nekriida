<?php
namespace Nekrida\Events;

use Nekrida\Core\Config;
use Nekrida\Core\Exceptions\DriverNotFoundException;
use Nekrida\Core\PHPLoader;

/**
 * Class EventDispatcher
 * @todo Completely rewrite the initialization process. Singleton to regular class
 * @package Nekrida\Events
 */
class EventDispatcher
{
	protected $listeners = [];

	/** @var self */
	private static $instance;

	/**
	 * Initializes the object
	 * TODO: Move to constructor
	 * This function exists solely because we need to pass the object of the EventDispatcher to the EventLoader,
	 * But at the time of the constructor the object doesn't yet exist
	 * @throws DriverNotFoundException
	 */
	private function init() {
		foreach (Config::get('app/events/loaders') as $loader => $parameters) {
			//Ignore disabled loaders
			if (isset($parameters['enabled']) && !$parameters['enabled'])
				continue;

			$driver = PHPLoader::getDriverClass("events",$loader);

			$res = call_user_func([$driver,'load'],$this,$parameters);
			if ($res && is_array($res))
				$this->listeners = array_merge($this->listeners,$res);
		}
	}

	private function __construct() {

	}

	/**
	 * @return self
	 * @throws DriverNotFoundException
	 */
	public static function getInstance() {
		if (!static::$instance) {
			static::$instance = new static();
			static::$instance->init();
		}
		return static::$instance;
	}

	/**
	 * Adds event listener.
	 * Usage:
	 * 	$this->listen('event.add','EventListener@onAdd')
	 * 	$this->listen('event.add',EventListener::class,'onAdd')
	 * 	$eventDispatcher->listen('event.add',$this::class,'onAdd')
	 *
	 * @param string $event Event to add the listener to
	 * @param string|object $controller Callable or the class or the full 'class@method'
	 * @param string $method Callable method, unless provided in the $controller
	 */
	public function listen($event,$controller, $method = "") {
		if (is_callable($controller)) {
			$this->listeners[$event][] = $controller;
			return;
		}
		if (is_object($controller)) {
			$res = (string)$controller;
		} elseif (is_string($controller)) {
			if (strpos('@',$controller)) {
				list($res,$method) = explode('@',$controller);
			} else {
				$res = $controller;
			}
		} else {
			$res = $controller[0];
			$method = $controller[1];
		}

		$this->listeners[$event][] = $res.'@'.$method;

	}

	/**
	 *
	 * @param Event $event
	 */
	public function dispatch(Event $event) {
		if (isset($this->listeners[$event->getName()]))
			foreach ($this->listeners[$event->getName()] as $listener) {
				if ($event->isPropagationActive()) {
					list($controller,$method) = explode('@',$listener);
					if (class_exists($controller))
						call_user_func([new $controller(), $method], $event);
				}
			}
	}
}