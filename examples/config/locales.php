<?php
return [
	'default' => 'ru',
	'sources' => [
		'cookie' => 'site_lang',
		'session' => 'lang',
	],
	'nameTemplates' => '{root}/resource/locales/{locale}.php',
	'view' => '\Nekrida\Locale\View',
];