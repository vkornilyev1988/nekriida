<?php
return [
	'database' => [
		//From databases config
		'class' => '\Nekrida\Log\Database',
		'database' => 'viasock',
		'table' => 'logs',
		'levels' => [],
	],
	'file' => [
		'class' => '\Nekrida\Log\File',
		'directory' => '/var/log/testapp',
		'fileTemplate' => '{date}.log',
		'levels' => ['critical','error','warning'],
	],
	'web' => [
		'class' => '\Nekrida\Log\Web',
		'levels' => ['error','success'],
	],
];