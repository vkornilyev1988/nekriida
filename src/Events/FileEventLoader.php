<?php
namespace Nekrida\Events;

use Nekrida\Core\PHPLoader;

class FileEventLoader implements EventLoaderInterface
{
	public static function load(EventDispatcher $dispatcher, array $param) {
		$listenersNamespaces = isset($param['listeners']) ? $param['listeners'] : [];

		$list = [];

		foreach ($listenersNamespaces as $namespace) {
			$classes = PHPLoader::getClassesByNamespace($namespace);

			foreach ($classes as $class) {
				if (class_exists($namespace.'\\'.$class)) {
					$className = $namespace . '\\' . $class;
						$obj = new $className;
					if (method_exists($obj,'listen')) {
						$obj->listen(EventDispatcher::getInstance());
					}
				}
			}
		}
	}
}