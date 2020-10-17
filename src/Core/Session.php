<?php


namespace Nekrida\Core;


use Nekrida\Core\Exceptions\DriverNotFoundException;
use SessionHandlerInterface;

/**
 * Class Session
 * @package Nekrida\Core
 */
class Session
{
	/** @var SessionHandlerInterface */
	protected $sessionHandler;

	/** @var array */
	protected $sessionArray;

	/** @var int */
	protected $maxLifeTime;

	/** @var string */
	protected $sessionId;

	/**
	 * Session constructor.
	 * @param int $sessionId
	 * @throws DriverNotFoundException
	 */
	public function __construct($sessionId = 0) {
		$this->sessionId = $sessionId ?:
			$this->generateSessionId(Config::get('session/random/size'),Config::get('session/random/symbols'));

		$sessionType = Config::get('session/type');

		$driver = PHPLoader::getDriverClass("session",$sessionType);

		$this->sessionHandler = new $driver();
	}

	/**
	 * @param int $size
	 * @param array $symbols
	 * @return string
	 */
	public function generateSessionId($size = 16,$symbols = []) {
		$id = '';

		for ($i = 0; $i < $size; $i++)
			$id .= $symbols[rand(0,count($symbols))];

		return $id;
	}

	/**
	 * Destroys session
	 */
	public function destroy() {
		if ($this->sessionHandler->destroy($this->sessionId))
			$this->sessionArray = [];
		$this->generateSessionId(Config::get('session/random/size'),Config::get('session/random/symbols'));
	}

	/**
	 * Opens the session
	 */
	public function open() {
		$ser = $this->sessionHandler->read($this->sessionId);
		$this->sessionArray = $ser ? unserialize($ser) : [];
	}

	/**
	 * Closes the session
	 */
	public function close() {
		$ser = serialize($this->sessionHandler);
		$this->sessionHandler->write($this->sessionId,$ser);
	}

	/**
	 * Returns
	 * @param $key null|string
	 * @return mixed|null
	 */
	public function get($key = null) {
		if (is_null($key))
			return $this->sessionArray;
		$keyArray = explode('/', $key);
		if (isset($this->sessionArray[$keyArray[0]]))
			$x = $this->sessionArray[$keyArray[0]];
		else
			return NULL;
		for ($i = 1; $i < count($keyArray); $i++)
			if (isset ($x[$keyArray[$i]]))
				$x = $x[$keyArray[$i]];
			else
				return NULL;
		return $x;
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function set($key, $value) {
		$keyArray = explode('/',$key);
		$x = &$this->sessionArray;

		for ($i = 0; $i < count($keyArray); $i++) {
			if (!isset($x[$keyArray[$i]]))
				$x[$keyArray[$i]] = [];
			$x = &$x[$keyArray[$i]];
		}
		$x = $value;
	}

	public function clearOld() {
		$this->sessionHandler->gc($this->maxLifeTime);
	}
}