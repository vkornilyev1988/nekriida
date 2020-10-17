<?php


namespace Nekrida\Routing;


use Nekrida\Core\Config;
use Nekrida\Core\Interfaces\RouteLoaderInterface;

class RouteLoader implements RouteLoaderInterface
{

	public static function load($parameters)
	{
		$filesRegexes = $parameters['sources'];
		foreach ($filesRegexes as $filesRegex) {
			$filesRegex = str_replace('{root}', Config::root(), $filesRegex);
			$filesList = glob($filesRegex);
			foreach ($filesList as $file) {
				include $file;
			}
		}
	}
}