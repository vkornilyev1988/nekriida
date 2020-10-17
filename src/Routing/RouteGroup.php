<?php


namespace Nekrida\Routing;

/**
 * Class RouteGroup
 * @package Nekrida\Routing
 */
class RouteGroup
{
	/** @var string */
	protected $namespace = '';
	/** @var string */
	protected $domain = '';
	/** @var string */
	protected $prefix = '';
	/** @var string[] */
	protected $middleware = [];

	/**
	 * @var array $restrictions
	 * key - variable name
	 * value - regex restriction
	 */
	protected $restrictions = [];

	/**
	 * @param $domain
	 * @return $this
	 */
	public function domain($domain) {
		$this->domain = $domain;
		return $this;
	}

	/**
	 * @param $routes RouteItem[]
	 * @return RouteItem[]
	 */
	public function group($routes) {
		$routes = $this->multiArrayToSimple($routes);

		foreach ($routes as $route) {
			$route->namespace($this->namespace)
				->domain($this->domain)
				->prefix($this->prefix)
				->middleware($this->middleware)
				->where($this->restrictions);
		}
		return $routes;
	}

	/**
	 * Adds middleware for routes in the group
	 * @param $middleware
	 * @return $this
	 */
	public function middleware($middleware) {
		if (is_array($middleware)) {
			foreach ($middleware as $item) {
				$this->middleware[] = $item;
			}
		}
		elseif (!empty($middleware))
			$this->middleware[] = $middleware;
		return $this;
	}

	/**
	 * Sets namespace for routes
	 * @param $namespace
	 * @return $this
	 */
	public function namespace($namespace) {
		$this->namespace = $namespace;
		return $this;
	}

	/**
	 * Sets url prefix for the routes in the group
	 * @param $prefix
	 * @return $this
	 */
	public function prefix($prefix) {
		$this->prefix = $prefix;
		return $this;
	}

	/**
	 * Sets restrictions for the variables of the url
	 * @param array $restrictions key - variable name; value - regex restriction
	 * @return $this
	 */
	public function where($restrictions) {
		foreach ($restrictions as $key => $value)
			$this->restrictions[$key] = $value;
		return $this;
	}

	/**
	 * Converts multidimensional array into simple one dimensional array
	 * @param $array
	 * @return array
	 * @protected
	 */
	protected function multiArrayToSimple ($array) {
		$arr2 = [];
		foreach ($array as $item)
			if (is_array($item))
				foreach ($item as $subItem)
					$arr2[] = $subItem;
			else
				$arr2[] = $item;
		return $arr2;
	}
}