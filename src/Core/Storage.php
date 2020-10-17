<?php


namespace Nekrida\Core;


use Nekrida\Core\Exceptions\DriverNotFoundException;
use Nekrida\Core\Interfaces\StorageInterface;

/**
 * Class Storage
 * @package Nekrida\Core
 */
class Storage
{
	const STORAGE_PREFIX = "st@";
	// Example url: st@exstor://path_to_file/file.txt

	/**
	 * @param $storage
	 * @return mixed
	 * @throws DriverNotFoundException
	 */
	protected static function getDriver($storage) {

		$config = Config::get("storage/$storage");

		$type = Config::get("storage/$storage/type");

		$driver = PHPLoader::getDriverClass("storage",$type);

		return new $driver($config);
	}

	/**
	 * @param $link
	 * @return bool
	 * @throws DriverNotFoundException
	 */
	public static function delete($link) {
		$storage = static::getStorageName($link);
		if (!$storage)
			throw new \UnexpectedValueException($link);
		$driver = self::getDriver($storage);

		return $driver->delete($link);
	}

	/**
	 * @param $link
	 * @param string $name
	 * @param string $mimeType
	 * @return Response
	 * @throws DriverNotFoundException
	 */
	public static function download($link,$name = '',$mimeType = '') {
		$storage = static::getStorageName($link);
		if (!$storage)
			throw new \UnexpectedValueException($link);

		$driver = self::getDriver($storage);
		return $driver->download($link,$name,$mimeType);
	}

	/**
	 * @param $link
	 * @param string $mimeType
	 * @return Response
	 * @throws DriverNotFoundException
	 */
	public static function get($link,$mimeType = '') {
		$storage = static::getStorageName($link);
		if (!$storage)
			throw new \UnexpectedValueException($link);

		$driver = self::getDriver($storage);

		return $driver->get($link,$mimeType);
	}

	/**
	 * @param $file
	 * @param $storage
	 * @param array $options
	 * @return bool
	 * @throws DriverNotFoundException
	 */
	public static function put($file,$storage,$options = []) {
		$driver = self::getDriver($storage);

		return $driver->put($file,$options,$storage);
	}

	/**
	 * @param $link
	 * @return string
	 * @throws DriverNotFoundException
	 */
	public static function url($link) {
		$storage = static::getStorageName($link);

		$driver = self::getDriver($storage);

		return $driver->url($link);
	}

	public static function getStorageName($url) {
		if (strpos($url,self::STORAGE_PREFIX) === 0) {
			$headEnd = strpos($url,'://');
			$prefixLength = strlen(self::STORAGE_PREFIX);
			return substr($url,$prefixLength,$headEnd - $prefixLength);
		}
		return false;
	}
}