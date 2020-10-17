<?php
return [
	'main' => [
		'driver' => 'mysql',
		'host' => '6.6.6.191',
		'port' => '3306',
		'user' => 'admin',
		'password' => 'qwerty',
		'schema' => 'testdb',
	],
	'postgr' => [
		'driver' => 'pgsql',
		'host' => '6.6.6.167',
		'port' => '5432',
		'user' => 'admin',
		'password' => 'qertyu',
		'schema' => 'testdb'
	],
	'viasock' => [
		'driver' => 'mysql',
		'socket' => '/var/run/mysql.sock',
		'user' => 'admin',
		'password' => 'qertyu',
		'schema' => 'testdb'
	],
];