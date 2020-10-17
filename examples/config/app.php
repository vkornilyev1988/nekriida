<?php
return [
	//{root} - project root.

	//If you use Composer you can omit this parameter
	//Nekrida namespace is initialized by default so no need to include it here
	'namespaces' => [
		'App' => '{root}/app',
		'TestLib' => '{root}/vendor/librai/testlib/src',
	],
	//Default middlewares namespace
	'middleware' => 'App\Middleware',
	//Routes locations
	'routes' => [
		'{root}/routes/*.php',
	],
	//Location of the routes cache. If no cache then null
	'routesCache' => null,
	'views' => [
		'layoutController' => '\App\Controllers\Header',
		//If the template engine is used set it here
		//'templateEngine' => 'Koks\Fantasy\Tpl',
		'postRenderers' => [
			'Nekrida\Locale\Legacy@localize'
		],
		//Views locations
		//{view} - view name
		'url' => [
			'{root}/views/{view}.php',
			'{root}/views/errors/404.php',
		],
	],
];