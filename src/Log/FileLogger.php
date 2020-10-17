<?php


namespace Nekrida\Log;


use Nekrida\Core\Interfaces\LoggerInterface;

/**
 * Class FileLogger
 * @package Nekrida\Log
 */
class FileLogger implements LoggerInterface
{
	protected $fileName;

	protected $dateFormat;

	protected $directory;

	protected $template;

	/**
	 * Initializes the logger
	 * @param array $config
	 */
	public function __construct($config) {
		$this->directory = $config['directory'] ?: '/var/log';
		$this->dateFormat = isset($config['dateFormat']) ? $config['dateFormat'] : 'Y-m-d h:i:s';
		$this->fileName = isset($config['fileName']) ? $config['fileName'] : 'app.log';
		$this->template = isset($config['logTemplate']) ? $config['logTemplate'] : '[{date}] {level}: {message}';
	}

	/**
	 * Logs the message
	 * @param $level
	 * @param string|mixed $message
	 * @param array $parameters Optional parameters for the logger (page, user etc.)
	 */
	public function log($level, $message, $parameters = []) {
		$f = fopen($this->directory.'/'.$this->fileName,'a');
		$date = date($this->dateFormat);
		fwrite($f,str_replace(['{date}','{level}','{message}'],[$date,$level,$message],$this->template).PHP_EOL);
		fclose($f);
	}
}