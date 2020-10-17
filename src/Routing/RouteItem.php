<?php


namespace Nekrida\Routing;


/**
 * Class RouteItem
 * @package Nekrida\Routing
 */
class RouteItem
{
	/** @var int */
	protected static $counter;

	/** @var string */
	protected $url;
	/** @var callable  */
	protected $callback;
	/** @var string */
	protected $name = '';
	/** @var array */
	protected $methods;
	/** @var string */
	protected $domain = '';
	/** @var array */
	protected $restrictions = [];
	/** @var string */
	protected $namespace = '';
	/** @var Middleware[] */
	protected $middleware = [];
	/** @var Middleware[] */
	protected $afterMiddleware = [];

	/**
	 * RouteItem constructor.
	 * @param $methods
	 * @param $url
	 * @param $callback
	 * @param array $middleware
	 */
	public function __construct($methods,$url, $callback, $middleware = []) {
		$this->url = $url;
		$this->callback = $callback;
		$this->methods = $methods;
		$this->middleware = $middleware;
		$this->name = static::$counter++;
	}

	//SETTERS

	/**
	 * @param $middleware
	 * @return $this
	 */
	public function after($middleware) {
		if (is_array($middleware))
			foreach ($middleware as $item) {
				$this->afterMiddleware[] = $middleware;
			}
		elseif (!empty($middleware))
			$this->afterMiddleware[] = $middleware;
		return $this;
	}

	/**
	 * @param $domain string
	 * @return $this
	 */
	public function domain($domain) {
		$this->domain = $domain;
		return $this;
	}

	/**
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
	 * @param $namespace string
	 * @return $this
	 */
	public function namespace($namespace) {
		if (is_string($this->callback) && strpos($this->callback,'\\') === 0) return $this;
		$this->namespace = $namespace . $this->namespace;
		return $this;
	}

	/**
	 * @param $name string
	 * @return $this
	 */
	public function name($name) {
		if (!empty($name)) {
			Route::nameRoute($this, $name);
			$this->name = $name;
		}
		return $this;
	}

	/**
	 * @param $prefix string
	 * @return $this
	 */
	public function prefix($prefix) {
		$this->url = $prefix . $this->url;
		return $this;
	}

	/**
	 * @param $restrictions array
	 * @return $this
	 */
	public function where($restrictions) {
		foreach ($restrictions as $key => $value) {
			$this->restrictions[$key] = $value;
		}
		return $this;
	}

	//public function setView($view) {$this->view = $view; return $this;}

	//GETTERS

	/**
	 * @return string
	 */
	public function getUrl() {return $this->url;}

	/**
	 * @return callable
	 */
	public function getCallback() {return $this->callback;}

	/**
	 * @return int|string
	 */
	public function getName() {return $this->name;}

	/**
	 * @return array
	 */
	public function getMethods() {return $this->methods;}

	/**
	 * @return string
	 */
	public function getDomain() {return $this->domain;}

	/**
	 * @return array
	 */
	public function getRestrictions() {return $this->restrictions;}

	/**
	 * @return string
	 */
	public function getNamespace() {return $this->namespace;}

	/**
	 * @return array|Middleware[]
	 */
	public function getMiddlewares() {return $this->middleware;}

	/**
	 * @return Middleware[]
	 */
	public function getAfter() {return $this->afterMiddleware;}

	/**
	 * @return mixed
	 */
	public function getView() {return $this->view;}
}