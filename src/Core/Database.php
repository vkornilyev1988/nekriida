<?php


namespace Nekrida\Core;

use Nekrida\Core\Exceptions\DriverNotFoundException;
use Nekrida\Core\Exceptions\DatabaseSchemaNotFoundException;
use Nekrida\Core\Interfaces\DatabaseFactoryInterface;

/**
 * Class Database
 * PDO objects factory
 * @package Nekrida\Core
 */
class Database
{
	protected static $instances = [];

	/**
	 * Returns database instance by name
	 * @param string $name
	 * @return mixed
	 * @throws DriverNotFoundException
	 */
	public static function getInstance($name = "main") {
		if (!isset(self::$instances[$name]) || !self::$instances[$name]) {
			$databaseCfg = Config::get("databases/".$name);
			if (!$databaseCfg || !isset($databaseCfg['driver']))
				throw new DriverNotFoundException();

			/** @var DatabaseFactoryInterface $driver */
			$driver = PHPLoader::getDriverClass("databases",$databaseCfg['driver']);

			self::$instances[$name] = call_user_func([$driver,'getInstance'],$databaseCfg);
		}

		return self::$instances[$name];
	}
}