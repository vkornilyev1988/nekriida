<?php


namespace Nekrida\Annotations;


use Nekrida\Core\Interfaces\RouteLoaderInterface;
use Nekrida\Core\PHPLoader;
use Nekrida\Routing\Route;
use Nekrida\Routing\RouteGroup;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * Class RouteLoader
 * @package Nekrida\Annotations
 */
class RouteLoader implements RouteLoaderInterface
{
	/**
	 * @param array $params Config parameters for the loader
	 */
	public static function load($params) {
		$namespaces = $params['namespaces'];

		foreach ($namespaces as $namespace) {
			$classes = PHPLoader::getClassesByNamespace($namespace);

			foreach ($classes as $class) {
				//Push routes of the controller to Route static class
				try {
					static::parseController($namespace . '\\' . $class);
				} catch (ReflectionException $e) {
					//This is not a controller
				}
			}
		}

	}

	/**
	 * Generates route list from the controller
	 * @param string $controller
	 * @throws ReflectionException
	 */
	protected static function parseController($controller) {

		//CLASS
		$reflection = new ReflectionClass($controller);

		$classDocParser = new DocParser($reflection->getDocComment());
		$classData = $classDocParser->has('Route') ? static::parseRoute($classDocParser->get('Route'))[0] : [];

		$routeGroup = new RouteGroup();
		if (isset($classData['url']))
			$classData['prefix'] = $classData['url'];
		foreach ($classData as $key => $item)
			if (method_exists($routeGroup, $key))
				$routeGroup->$key($item);

		//METHODS
		$routes = [];

		foreach($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			$methodDocParser = new DocParser($method->getDocComment());
			if ($methodDocParser->has('Route')) {
				$newRoutes = static::parseRoute($methodDocParser->get('Route'));

				foreach ($newRoutes as $newRoute) {
					$route = Route::match($newRoute['method'], $newRoute['url'], $controller.'@'.$method->getName());
					foreach ($newRoute as $key => $item)
						if ($key != "method" && $key != "url")
							if (method_exists($route,$key))
								$route->$key($item);
					$routes[] = $route;
				}
			}
		}
		//Apply class route attributes to methods routes
		$routeGroup->group($routes);
	}

	/**
	 * Generates route
	 * @param array $routeArray Result of parseDoc function
	 * @return array Route parameters
	 */
	protected static function parseRoute($routeArray) {

		$routes = [];

		foreach ($routeArray as $item) {
			$squareOpen = strpos($item,'[');
			$squareClose = strpos($item,']');
			$roundOpen = strpos($item,'(');
			$roundClose = strrpos($item,')'); //Last round bracket

			//Method
			//IF no method provided
			//THEN any method
			if ($squareOpen > $roundOpen || $squareOpen === false || $squareClose === false)
				$methods = ['get', 'post', 'put', 'head', 'delete', 'patch'];
			else
				$methods = explode(',', substr($item, $squareOpen + 1, $squareClose - $squareOpen - 1));

			//Route arguments
			$arguments = explode(',',substr($item,$roundOpen + 1, $roundClose - $roundOpen - 1));

			//[methods](route, ...attributes)
			//[get,post]("/rules/{id}/{name}", name = "FirewallRules", where = {
			//	 "id": "[0-9]+"}
			// )

			//Remove quotes
			$url = str_replace(['"',"'"],['',''],trim($arguments[0]));

			$parsedArguments = ['url' => $url, 'method' => $methods];

			for ($i = 1; $i < count($arguments); $i++) {
				$str = explode('=',$arguments[$i]);
				if (strpos($str[1],'{') || strpos($str[1],'['))
					$parsedArguments[trim($str[0])] = json_decode($str[1],true);
				else
					$parsedArguments[trim($str[0])] = str_replace(['"', "'"], ['', ''], trim($str[1]));
			}
			$routes[] = $parsedArguments;
		}
		return $routes;
	}
}