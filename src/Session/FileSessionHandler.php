<?php


namespace Nekrida\Session;


use Nekrida\Core\Config;
use Nekrida\Core\Interfaces\SessionHandlerInterface;
use const DIRECTORY_SEPARATOR;

class FileSessionHandler implements SessionHandlerInterface {

	protected static $storageRoot;

	protected static $prefix = 'sess_';

	public function __construct() {
		static::$storageRoot = Config::get('session/root');
		static::$prefix = Config::get('session/prefix');
	}

	public function open($savePath, $sessionName) {

	}

	public function close() {

	}

	public function read($sessionId) {
		$data = file_get_contents(static::$storageRoot. DIRECTORY_SEPARATOR.static::$prefix.$sessionId);
		if (!$data)
			$data = '';
		return $data;
	}

	public function write($sessionId, $data) {
		return !!file_put_contents(static::$storageRoot.DIRECTORY_SEPARATOR.static::$prefix.$sessionId, $data);
	}

	public function destroy($sessionId) {
		return unlink(static::$storageRoot.DIRECTORY_SEPARATOR.static::$prefix.$sessionId);
	}

	public function gc($lifetime) {
		$now = time();
		foreach (glob(static::$storageRoot.DIRECTORY_SEPARATOR.static::$prefix.'*') as $filename) {
			$lastModified = filemtime($filename);
			if ($lastModified === false)
				return false;
			if ($lastModified + $lifetime < $now)
				unlink($filename);
		}
		return true;
	}
}