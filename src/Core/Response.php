<?php


namespace Nekrida\Core;


use Nekrida\Core\Interfaces\ResponderInterface;
use Nekrida\Locale\Legacy;
use Nekrida\Routing\Route;

/**
 * Class Response
 * @package Nekrida\Core
 */
class Response
{
	/** @var Request */
	protected $request;

	/** @var array  */
	protected static $headers = [];

	/** @var array */
	protected static $cookies = [];

	/** @var int */
	protected static $httpStatus = 200;

	/** @var string */
	protected $body;

	/** @var string */
	protected $link;

	protected $loaderClass;

	/** @var ResponderInterface[] */
	protected static $loaderObjects = [];

	/**
	 * Response constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		$this->request = $request;
		$this->loaderClass = Config::get('app/views/defaultRenderer');
	}

	/**
	 * @param $text
	 * @return string
	 */
	public function postRender($text) {
		return Legacy::localize($text,$this->request);
	}

	/**
	 * Respond file
	 * @param $link
	 * @return $this
	 */
	public function file($link) {
		$this->link = $link;
		return $this;
	}

	/**
	 * Generate json response
	 * @param array $parameters
	 * @return $this
	 */
	public function json($parameters = []) {
		$this->header('Content-Type','application/json');
		$this->body = $this->postRender(json_encode($parameters));
		return $this;
	}

	/**
	 * Generates raw string response
	 * @param string $string
	 * @return $this
	 */
	public function raw($string) {
		$this->body = $string;
		return $this;
	}


	/**
	 * Generate html page response with layout
	 * @param $view string
	 * @param array $parameters
	 * @return $this
	 */
	public function render($view,$parameters = []) {
		$this->loadClass($this->loaderClass);
		$total = static::$loaderObjects[$this->loaderClass]->render($view,$parameters);

		$this->body = $this->postRender($total);

		return $this;
	}

	public function getRenderer($name) {
		$this->loadClass($this->loaderClass);

	}

	private function loadClass($name) {
		if (!isset(static::$loaderObjects[$name])) {
			$driver = PHPLoader::getDriverClass("views",$name);
			static::$loaderObjects[$name] = new $driver(
				$this->request,
				Config::get('app/views/renderers/'.$name)
			);
		}
	}

	/**
	 * Generate html page response
	 * @param $view string
	 * @param array $parameters
	 * @return $this
	 */
	public function view($view, $parameters = []) {
		$this->loadClass($this->loaderClass);

		$total = static::$loaderObjects[$this->loaderClass]->view($view,$parameters);

		$this->body = $this->postRender($total);

		return $this;
	}

	/**
	 * Generates http redirect
	 * @param $link
	 * @param array $options
	 * @param int $httpStatus
	 * @return $this
	 */
	public function redirect($link, $options = [], $httpStatus = 302) {
		static::$headers['Location'] = $this->generateUrl($link,$options);
		static::$httpStatus = $httpStatus;
		return $this;
	}

	public function redirectRoute($routeName, $options = [], $httpStatus = 302) {
		if (!class_exists('Nekrida\Routing\Route'))
			return $this->redirect($routeName,$options,$httpStatus);

		$url = Route::route($routeName);
		if ($url)
			$url = $url->getUrl();

		static::$headers['Location'] = $this->generateUrl($url,$options);
		static::$httpStatus = $httpStatus;
		return $this;
	}

	//TO USE IN VIEWS

	/**
	 * Adds alert message to the view. All alerts are destroyed after being printed in the view
	 * Alert format: [
	 * 	'type' => $type,
	 * 	'message' => $message,
	 * 	'header' => $header
	 * ]
	 * @param string $type
	 * @param string $message
	 * @param string $header
	 * @return $this
	 */
	public function alert($type, $message, $header = '') {
		$currentAlerts = json_decode($_SESSION['_alerts'], true);
		$currentAlerts[] = ['type' => $type, 'message' => $message, 'header' => $header];
		$_SESSION['_alerts'] = json_encode($currentAlerts);
		return $this;
	}

	/**
	 * @param $controller
	 * @param $method
	 * @param array $parameters
	 * @return mixed
	 */
	public function load($controller, $method, $parameters = []) {
		$res = call_user_func_array([new $controller($this->request), $method], $parameters);
		return $res->getBody();
	}

	/**
	 * Returns url filled with parameters
	 * @param $url
	 * @param array $parameters
	 * @return string|string[]|null
	 */
	public function generateUrl($url, $parameters = []) {
		if (empty($parameters))
			return $url;
		$counter = 0;
		$url = preg_replace_callback('/{([A-Za-z]*?)}/', function ($matches) use ($parameters, &$counter) {
			$inputName = $matches[1];
			return isset($parameters[$inputName]) ? $parameters[$inputName] : $parameters[$counter++];
		}, $url);
		return $url;
	}

	/**
	 * Set header
	 * @param $key string
	 * @param $value string
	 * @param bool $stack
	 * @return $this
	 */
	public function header($key, $value, $stack = false) {
		static::$headers[$key] = $value;
		return $this;
	}

	/**
	 * @param $name
	 * @param string $value
	 * @param int $expires
	 * @param string $path
	 * @param string $domain
	 * @param bool $secure
	 * @param bool $httponly
	 * @return $this
	 */
	public function cookie( $name, $value = "", $expires = 0, $path = "", $domain = "", $secure = false , $httponly = false) {
		static::$cookies[$name] = [
			'value' => $value,
			'Expires' => $expires,
			'Path' => $path,
			'Domain' => $domain,
			'Secure' => $secure,
			'HttpOnly' => $httponly
		];
		return $this;
	}

	/**
	 * Set http status
	 * @param $httpStatus int
	 * @return $this
	 */
	public function status($httpStatus) {
		static::$httpStatus = $httpStatus;
		return $this;
	}

	/**
	 * @return int
	 */
	public static function getStatus() {
		return self::$httpStatus;
	}

	/**
	 * Set http status
	 * @param $httpStatus int
	 */
	public static function setStatus($httpStatus)
	{
		self::$httpStatus = $httpStatus;
	}

	/**
	 * @return array
	 */
	public static function getHeaders() {
		return self::$headers;
	}

	public static function clearHeaders() {
		self::$headers = [];
	}

	/**
	 * @param string $cookie
	 * @return mixed|null
	 */
	public function getCookie($cookie) {
		return isset(self::$cookies[$cookie]) ? self::$cookies[$cookie] : null;
	}

	/**
	 * @return array
	 */
	public function getCookies() {
		return self::$cookies;
	}

	/**
	 * @param string $cookie
	 * @return $this
	 */
	public function deleteCookie($cookie) {
		unset(self::$cookies[$cookie]);
		return $this;
	}

	/**
	 *
	 */
	public static function clearCookies() {
		self::$cookies = [];
	}

	/**
	 * @return mixed
	 */
	public function getBody() {
		return $this->body;
	}

	/**
	 * @return bool
	 */
	public function hasLink() {
		return !!$this->link;
	}

	/**
	 *
	 */
	public function printLink() {
		readfile($this->link);
	}

}