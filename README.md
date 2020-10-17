Nekrida
==========
Nekrida is a web application framework with no dependencies and allowing flexible directory management.

Configuration
---------
Main configuration file lies in config/app.php which returns php array.

Parameters:
* namespaces - psr-4 autoloader. If you use Composer you don't need to fill this parameter  
  type: array  
    key: namespace  
    value: real path  
* middleware - default middlewares namespace
* routes - array of routes paths (used by glob function)
* routesCache - path to routes cache
* views
  * layoutController - controller used to generate layout of the html page
  * url - paths to the views in order of accessibility. The last url is a 404 error. {view} is replaced to the name of the requested view.

```php
#config/app.php
return [
	//{root} - project root.
    
	'namespaces' => [
		'App' => '{root}/app',
		'TestLib' => '{root}/vendor/librai/testlib/src',
	],
	'middleware' => 'App\Middleware',
	'routes' => [
		'{root}/routes/*.php',
	],
	'views' => [
		'layoutController' => '\App\Controllers\Header',
		'url' => [
			'{root}/views/{view}.php',
			'{root}/views/errors/404.php',
		],
	],
];

```
#### Databases.php

Contains php array of different sql connections. Array key - name of the database used in the code

Parameters:
* driver - database driver
* host
* port (optional)
* socket - unix socket (if used host and port are omitted)
* user
* password
* schema

#### Locales.php

Parameters:
* default - default locale  
* sources - where to get the desired locale name  
  * cookie - name of the cookie holding the locale name
  * session - name of the session attribute holding the locale name

* nameTemplates - path template where to search for locales. {locale} is replaced by the locale name

#### Storage.php

Parameters:
* type - type of the storage

  For local:
  * root - root of the virtual storage
  * directory - directories template of the virtual storage
  * fileTemplate - file name template. {name} is replaced with original file name
  * random - which parameters in curly braces to set using random number generator
    * parameter name
      * size - size of the name
      * symbols - array of symbols used to generate the name