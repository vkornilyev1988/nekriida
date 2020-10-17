<?php

namespace Nekrida\Core;

/**
 * Class Config
 * @package Nekrida\Core
 */
class Config {

	/** @var array */
	protected static $config;

	/** @var string */
	protected static $root;

	/**
	 * Imports file by file name
	 * @param $file string file name
	 */
	public static function import($file) {
		$temp = explode('/', $file);
		$name = explode('.',$temp[count($temp)-1])[0];
		self::$config[$name] = @include $file;
	}

	/**
	 * Imports all configuration files from {root}/config directory
	 */
	public static function importAll() {
		$files = glob(self::$root.'/config/*.php');
		foreach ($files as $file) {
			self::import($file);
		}
	}

	/**
	 * Prints configs in php format to the files
	 * @param mixed ...$configs
	 */
	public static function export(...$configs) {
		$directory = self::$root.'/config/';
		foreach (self::$config as $key => $value) {
			if (in_array($key,$configs))
				file_put_contents($directory.$key.'.php', '<?php'.PHP_EOL.'return '.var_export($value,true).';');
		}
	}

	/**
	 * Prints configs in php format to the files
	 * @param array $except Exluded configuration files
	 */
	public static function exportAll($except = ['config']) {
		$directory = self::$root.'/config/';
		foreach (self::$config as $key => $value) {
			if (!in_array($key,$except))
				file_put_contents($directory.$key.'.php', '<?php'.PHP_EOL.'return '.var_export($value,true).';');
		}
	}

	/**
	 * If key = null returns the whole config
	 * If key is set returns the config value under this key
	 *
	 * Key is the key of associative array separated by "/" (slash)
	 * The first key is the config file name excluding '.php' ending.
	 *
	 * Example: $key = 'app/namespace/App' corresponds to the file config/app.php, array key `['namespace']['App']`
	 *
	 * @param $key
	 * @return mixed
	 */
	public static function get($key = null) {
		return is_null($key) ? self::$config : self::getValueByKey($key);
	}

	/**
	 * Returns root directory of the project
	 * @return string
	 */
	public static function root() {
		return self::$root;
	}

	/**
	 * Set root directory
	 * @param $root
	 */
	public static function setRoot($root) {
		self::$root = $root;
	}

	/**
	 * Sets value to the configuration
	 * @param $key
	 * @param $value
	 */
	public static function set($key,$value) {
		$keyArray = explode('/',$key);
		$x = &self::$config;

		for ($i = 0; $i < count($keyArray); $i++) {
			if (!isset($x[$keyArray[$i]]))
				$x[$keyArray[$i]] = [];
			$x = &$x[$keyArray[$i]];
		}
		$x = $value;
	}

	/**
	 * @param $key string
	 * @return array|mixed|null
	 */
	protected static function getValueByKey($key) {
		// $key = 'rules/10/item';
		$key_array = explode('/', $key);
		if (isset(self::$config[$key_array[0]]))
			$x = self::$config[$key_array[0]];
		else
			return NULL;
		for ($i = 1; $i < count($key_array); $i++)
			if (isset ($x[$key_array[$i]]))
				$x = $x[$key_array[$i]];
			else
				return NULL;
		if (is_string($x))
			return str_replace('{root}',self::$root,$x);
		if (is_array($x))
			foreach ($x as $key=>$value)
				$x[$key] = str_replace('{root}',self::$root,$x[$key]);
		return $x;
	}
}
