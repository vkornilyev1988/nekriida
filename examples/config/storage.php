<?php
return [
	'_drivers' => [
		'local' => 'Nekrida\Storage\LocalStorage',
	],

	'main' => [
		'type' => 'local',
		'root' => '{root}/public/storage',
		'directory' => '{dir}',
		//{name} - real file name
		'fileTemplate' => '{f}-{name}',

		'random' => [
			'dir' => [
				'size' => 3,
				'symbols' => ['0','1','2','3','4','5','6','7','8','9'],
			],
			'f' => [
				'size' => 3,
				'symbols' => ['0','1','2','3','4','5','6','7','8','9'],
			],
		],
	],
	'backups' => [
		'type' => 'local',
		'root' => '/backups',
	],
	'certs' => [
		'type' => 'local',
		'root' => '/data/CA',
	],
	'gdk' => [
		'type' => 'gdk',
		'credentials' => '{root}/gdk/credential.json',
		'host' => '7.55.23.56',
	],
];