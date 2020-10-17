<?php

namespace Nekrida\Routing;

use Nekrida\Core\Config;
use Nekrida\Core\Exceptions\DriverNotFoundException;
use Nekrida\Core\PHPLoader;

/**
 * Class Route
 * @package Nekrida\Routing
 */
class Route
{
	/** @var RouteItem[] */
	protected static $routes = [];

	/** @var RouteItem */
	protected static $currentRoute;

	public static function cache() {
		$cacheFile = Config::get('app/routes/cache');
		file_put_contents($cacheFile,serialize(static::$routes));
	}

	/**
	 * @throws DriverNotFoundException
	 */
	public static function import() {
		$cacheFile = Config::get('app/routes/cache');
		if ($cacheFile && file_exists($cacheFile)) {
			$string = file_get_contents($cacheFile);
			static::$routes = unserialize($string);
		} else {
			foreach (Config::get('app/routes/loaders') as $routeLoader => $parameters) {
				if (!isset($parameters['enabled']) || $parameters['enabled']) {
					$driver = PHPLoader::getDriverClass("routes",$routeLoader);

					call_user_func([$driver,'load'],$parameters);
				}
			}
			if ($cacheFile)
				static::cache();
		}
	}

	/**
	 * @return RouteItem[]
	 */
	public static function getRoutes() {
		return static::$routes;
	}

	/**
	 * @param RouteItem $currentRoute
	 */
	public static function setCurrentRoute(RouteItem $currentRoute)
	{
		self::$currentRoute = $currentRoute;
	}

	/**
	 * @param RouteItem $route
	 * @return RouteItem
	 */
	public static function addRoute(RouteItem $route)
	{
		self::$routes[$route->getName()] = $route;
		return $route;
	}

	/**
	 * @param RouteItem $route
	 * @param $name
	 * @return RouteItem
	 */
	public static function nameRoute(RouteItem $route, $name) {
		self::$routes[$name] = $route;
		unset(self::$routes[$route->getName()]);
		return $route;
	}

	/**
	 * @param bool|string $name
	 * @return RouteItem|null
	 */
	public static function route($name = false) {
		if ($name)
			return isset(self::$routes[$name]) ? self::$routes[$name] : null;
		else
			return self::$currentRoute;
	}

	public static function serialize() {
		//serialize(static::$routes);
	}

	//To be used in routes files

		//General function
	/**
	 * @param string[] $methods array of methods
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function match($methods, $url, $callback) {
		return self::addRoute(new RouteItem($methods,$url,$callback));
	}

	/**
	 * Any methods
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function any($url, $callback) {
		return self::addRoute(new RouteItem(['get','post','put','head','delete','patch'],$url,$callback));
	}

		//GET, POST, PATCH, DELETE

	/**
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function delete($url, $callback) {
		return self::addRoute(new RouteItem(['delete'],$url,$callback));
	}

	/**
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function get($url, $callback) {
		return self::addRoute(new RouteItem(['get'],$url,$callback));
	}

	/**
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function patch($url, $callback) {
		return self::addRoute(new RouteItem(['patch'],$url,$callback));
	}

	/**
	 * @param string $url
	 * @param string|callable $callback
	 * @return RouteItem
	 */
	public static function post($url, $callback) {
		return self::addRoute(new RouteItem(['post'],$url,$callback));
	}

	/**
	 * @param $url
	 * @param $callback
	 * @return RouteItem
	 */
	public static function put($url, $callback) {
		return self::addRoute(new RouteItem(['put'],$url,$callback));
	}

	// For RouteGroups

	/**
	 * @param $domain
	 * @return RouteGroup
	 */
	public static function domain($domain) {
		$group = new RouteGroup();
		return $group->domain($domain);
	}

	/**
	 * @param $middleware
	 * @return RouteGroup
	 */
	public static function middleware($middleware) {
		$group = new RouteGroup();
		return $group->middleware($middleware);
	}

	/**
	 * @param $namespace
	 * @return RouteGroup
	 */
	public static function namespace($namespace) {
		$group = new RouteGroup();
		return $group->namespace($namespace);
	}

	/**
	 * @param $prefix
	 * @return RouteGroup
	 */
	public static function prefix($prefix) {
		$group = new RouteGroup();
		return $group->prefix($prefix);
	}

	/**
	 * @return RouteItem
	 */
	public static function getCurrentRoute() {
		return self::$currentRoute;
	}
}