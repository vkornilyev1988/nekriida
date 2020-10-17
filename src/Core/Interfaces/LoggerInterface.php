<?php


namespace Nekrida\Core\Interfaces;

/**
 * Interface LoggerInterface
 * @package Nekrida\Core\Interfaces
 */
interface LoggerInterface
{
	/**
	 * Initializes the logger
	 * @param array $config
	 */
	public function __construct($config);

	/**
	 * Logs the message
	 * @param $level
	 * @param string|mixed $message
	 * @param array $parameters Optional parameters for the logger (page, user etc.)
	 */
	public function log($level, $message, $parameters = []);
}