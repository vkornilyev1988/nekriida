<?php
namespace Nekrida\Events;

use Nekrida\Core\Config;

class ConfigEventLoader implements EventLoaderInterface
{
	public static function load(EventDispatcher $dispatcher,array $config = []) {
		return Config::get('events');
	}
}