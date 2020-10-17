<?php


namespace Nekrida\Core;

use Nekrida\Core\Exceptions\DriverNotFoundException;
use Nekrida\Core\Interfaces\LoggerInterface;

/**
 * Class Log
 * @package nekrida\Core
 */
class Log
{
	/** @var LoggerInterface[] */
	private static $loggers = [];

	private static $levels = [];

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function emergency($message)
	{
		static::log('emergency',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function alert($message)
	{
		static::log('alert',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function critical($message)
	{
		static::log('critical',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function error($message)
	{
		static::log('error',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function warning($message)
	{
		static::log('warning',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function notice($message)
	{
		static::log('notice',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function info($message)
	{
		static::log('info',$message);
	}

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function debug($message)
	{
		static::log('debug',$message);
	}

	//NOT STANDARD

	/**
	 * @param string|array $message
	 * @throws DriverNotFoundException
	 */
	public static function success($message) {
		static::log('success',$message);
	}

	protected static function init() {
		if (!static::$levels)
			foreach (Config::get('log') as $logger => $data) {
				foreach ($data['levels'] as $loggerLevel)
					static::$levels[$loggerLevel][] = $logger;
			}
	}

	/**
	 * @param $logger
	 * @return LoggerInterface
	 * @throws DriverNotFoundException
	 */
	protected static function initLogger($logger) {
		$driver = PHPLoader::getDriverClass("log",$logger);

		return new $driver(Config::get('log/'.$logger));
	}

	/**
	 * @param string $level
	 * @param string|array $message
	 * @param array $parameters
	 * @throws DriverNotFoundException
	 */
	public static function log($level,$message,$parameters = []) {
		static::init();

		if (isset(static::$levels[$level]))
			foreach (static::$levels[$level] as $logger) {
				if (!isset(static::$loggers[$logger])) {
					static::$loggers[$logger] = static::initLogger($logger);
				}
				static::$loggers[$logger]->log($level,$message, $parameters);
			}
	}
}