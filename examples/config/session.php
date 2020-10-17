<?php
return [
	//Classes implementing the session handling
	'_drivers' => [
		'file' => 'Nekrida\Session\FileSessionHandler',
		'database' => '',
		'redis' => '',
		'memcached' => '',
	],
	'enabled' => true,
	'type' => 'file',
	// FOR type = file
		//root directory for sessions
	'root' => '{root}/sessions',
		//session file name randomizer
	'random' => [
		'size' => 12,
		'symbols' => array_merge(range('a','z'),range('0','9'))
	],
];