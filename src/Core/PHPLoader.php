<?php


namespace Nekrida\Core;


use Composer\Autoload\ClassLoader;
use Nekrida\Core\Exceptions\DriverNotFoundException;
use const DIRECTORY_SEPARATOR;

class PHPLoader
{
	protected static $autoLoad = [];

	/**
	 * @param null|ClassLoader $composer
	 * @return mixed
	 */
	protected static function getExistingNamespaces($composer) {
		if ($composer)
			return $composer->getPrefixesPsr4();
		else
			//For backward compatibility
			return Config::get('app/namespaces');
	}

	public static function getClassesByNamespace($namespace) {
		global $composer;
		if (!self::$autoLoad)
			static::$autoLoad = static::getExistingNamespaces($composer);

		//Get the best suiting autoload namespace for the requested namespace
		//Best suiting namespace has the longest name
		$betterSuiting = '';
		foreach (static::$autoLoad as $item => $arr)
			if (strpos($namespace,$item) === 0 && strlen($item) > strlen($betterSuiting))
				$betterSuiting = $item;

		//Path from the autoload
		if ($composer)
			$rootPath = static::$autoLoad[$betterSuiting][0];
		else
			$rootPath = Config::root();

		//Actual path of the namespace
		$realPath = $rootPath . DIRECTORY_SEPARATOR . str_replace([$betterSuiting,'\\'],['','/'],$namespace);

		//For each controller
		$files = array_diff(glob($realPath.'/*.php'),['..','.']);

		$res = [];

		foreach ($files as $file) {
			//Class name for PSR-4
			$name = substr($file, strrpos($file, DIRECTORY_SEPARATOR) + 1); //Delete folders from the name
			$name = substr($name, 0, strpos($name, '.')); // In case someone decided to name the controller Name.class.php

			$res[] = $name;
		}

		return $res;

	}

	/**
	 * Returns the class for the particular driver. Throws DriverNotFoundException if the driver was not found
	 * @param string $type Driver type
	 * @param string $driver Driver name
	 * @return string Class name
	 * @throws DriverNotFoundException
	 */
	public static function getDriverClass($type,$driver) {
		$driverClass = Config::get("drivers/".$type."/".$driver);

		if (!$driverClass)
			throw new DriverNotFoundException($type." ".$driver);
		if (!class_exists($driverClass))
			throw new DriverNotFoundException($driverClass);

		return $driverClass;
	}
}