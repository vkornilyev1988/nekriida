<?php


namespace Nekrida\Database;


use Nekrida\Core\Interfaces\DatabaseFactoryInterface;
use PDO;

class SQLFactory implements DatabaseFactoryInterface
{
	public static function getInstance($config) {
		if (isset($config['socket']))
			$address = 'unix_socket='.$config['socket'];
		else {
			$host = isset($config['host']) ? $config['host'] : '127.0.0.1'; //'localhost' is not allowed in PDO
			$address = 'host='.$host;
			if (isset($config['port']))
				$address .= ';port='.$config['port'];
		}
		$pdoDsn = $config['driver'] . ':' . $address . ';dbname='.$config['schema'];
		$user = isset($config['user']) ? $config['user'] : null;
		$password = isset($config['password']) ? $config['password'] : null;
		$pdo = new PDO($pdoDsn,$user,$password,[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);
		if(isset($config['charset']))
			$pdo->query("SET NAMES '".$config['charset']."'");

		return $pdo;
	}

}