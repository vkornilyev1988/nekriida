<?php


namespace Nekrida\Routing;


use Nekrida\Core\Config;
use Nekrida\Core\Request;
use Nekrida\Core\Response;

/**
 * Class Router
 * @package Nekrida\Routing
 */
class Router
{
	/** @var Request */
	protected $request;

	/**
	 * Router constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}

	/**
	 * @return Response
	 */
	public function run() {
		/*foreach(Config::get('app/routes') as $route) {
			Route::importFromTemplate($route);
		}*/
		Route::import();

		return $this->handle();

	}

	/**
	 * @return Response
	 */
	public function handle() {
		foreach (Route::getRoutes() as $route) {
			//Check method
			if (!in_array($this->request->method(),$route->getMethods()))
				continue;

			//TODO: Check domain

			//Pre check
			$varPos = strpos($route->getUrl(),'{');
			//IF no vars
			//THEN IF urls aren't equal
			//	THEN it's not our client
			if ($varPos === false) {
				if (strpos($this->request->url(),$route->getUrl()) === false)
					continue;
				$param = [];
			} else {
				//strpos check first because it's much faster then preg_replace + preg_match for each route
				if (strpos($this->request->url(),substr($route->getUrl(),0,$varPos)) === false)
					continue;

				//Save inputs names
				$inputNames = [];

				$pattern = preg_replace_callback('/{([\w]*?)}/', function ($matches) use (&$inputNames) {
					$inputNames[] = $matches[1];
					return '([^\/]+?)';
				}, $route->getUrl());

				if (!preg_match_all('#^' . $pattern . '$#', $this->request->url(), $matches, PREG_OFFSET_CAPTURE))
					continue;

				//Get inputs
				$matches = array_slice($matches, 1);
				$param = [];
				for ($i = 0; $i < count($matches); $i++) {
					$param[$inputNames[$i]] = $matches[$i][0][0];
				}

				if (!$this->checkRestrictions($param, $route->getRestrictions()))
					continue;

				$this->request->setInput($param);
			}

			//Process Before Middlewares
			if (!$this->handleMiddleware($route->getMiddlewares(),$param,Config::get('app/middleware')))
				continue;

			//Process Controller
			Route::setCurrentRoute($route);
			$res = $this->invoke($route->getCallback(),$this->request->input(),$route->getNamespace());

			//Process After Middlewares
			$this->handleMiddleware($route->getAfter(),$this->request->input(),Config::get('app/middleware'));

			return $res;
		}

		return $this->notFound();
	}

	/**
	 * Checks if input values correspond to restrictions
	 * @param $values
	 * @param $restrictions array `name => Regex_string`
	 * @return bool
	 */
	protected function checkRestrictions($values,$restrictions) {
		foreach ($restrictions as $key => $value) {
			if (isset($values[$key]) && !preg_match('#^'.$value.'$#',$values[$key]))
				return false;
		}
		return true;
	}

	/**
	 * @param $middlewares
	 * @param $param
	 * @param $namespace
	 * @return bool
	 */
	protected function handleMiddleware($middlewares,$param,$namespace) {
		foreach ($middlewares as $middleware) {
			if ($namespace)
				$middleware = $namespace.'\\'.$middleware;
			if (!$this->invoke($middleware,$param))
				return false;
		}
		return true;
	}

	/**
	 * @param $func
	 * @param $param
	 * @param string $namespace
	 * @return bool|mixed
	 */
	protected function invoke($func,$param,$namespace = '') {
		if ($namespace)
			$func = $namespace .'\\'.$func;
		if (is_callable($func))
			if (strpos($func,'::') === false)
				//Non-Static
				return call_user_func_array($func, $param);
			else {
				//Static
				$param['request'] = $this->request;
				return call_user_func_array($func, $param);
			}

		elseif (stripos($func,'@') !== false) {
			list($controller,$method) = explode('@',$func);
			if (class_exists($controller)) {
				$res = call_user_func_array([new $controller($this->request), $method], $param);
				return $res;
			} else {
				//$this->sendError($controller);
				return false;
			}
		} elseif (class_exists(($namespace ? $namespace.'\\' : '') . $func)) {
			$func = ($namespace ? $namespace.'\\' : '') . $func;
			$res = new $func($param);
			return $res;
		}
		//$this->sendError($func);
	}

	/**
	 * @return Response
	 */
	protected function notFound() {
		$response = new Response($this->request);
		return $response->render('')
			->status(404);
	}
}