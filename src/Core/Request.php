<?php


namespace Nekrida\Core;

/**
 * Class Request
 * Read-only class containing user input
 * @package Nekrida\Core
 */
class Request
{
	/** @var string */
	protected $url;

	/** @var string */
	protected $domain;

	/** @var string */
	protected $guid;

	/** @var array */
	protected $get;

	/** @var array */
	protected $post;

	/** @var array */
	protected $request;

	/** @var array */
	protected $server;

	/** @var array */
	protected $session;

	/** @var array */
	protected $cookie;

	/** @var array */
	protected $files;

	/** @var array */
	protected $input;

	/** @var array */
	protected $cache = [];

	//GETTERS

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function get($key = NULL) { return is_null($key) ? $this->get : $this->getValueByKey('get', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function post($key = NULL) { return is_null($key) ? $this->post : $this->getValueByKey('post', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function request($key = NULL) { return is_null($key) ? $this->request : $this->getValueByKey('request', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function server($key = NULL) {return is_null($key) ? $this->server : $this->getValueByKey('server', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function session($key = NULL) {return is_null($key) ? $this->session : $this->getValueByKey('session',$key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function cookie($key = NULL) {return is_null($key) ? $this->cookie : $this->getValueByKey('cookie', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function files($key = NULL) {return is_null($key) ? $this->files : $this->getValueByKey('files', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function input($key = NULL) {return is_null($key) ? $this->input : $this->getValueByKey('input', $key);}

	/**
	 * @param null|string $key
	 * @return mixed
	 */
	public function cache($key = NULL) {return is_null($key) ? $this->cache : $this->getValueByKey('cache', $key);}

	/**
	 * @return null|string
	 */
	public function url() {return $this->url;}

	/**
	 * @return null|string
	 */
	public function guid() {return $this->guid;}

	/**
	 * @return null|string
	 */
	public function domain() {return $this->domain;}

	/**
	 * @return null|string
	 */
	public function method() {
		if (isset($this->server['REQUEST_METHOD']))
			if ($this->server['REQUEST_METHOD'] == 'POST')
				if (isset($this->post['_method']))
					return strtolower($this->post['_method']);
				else return 'post';
			else
				return strtolower($this->server['REQUEST_METHOD']);
		else {
			if (empty($this->post))
				return 'get';
			elseif (isset($this->post['_method']))
				return strtolower($this->post['_method']);
			else return 'post';
		}
	}

	/**
	 * @return bool
	 */
	public function isAjax() {
		return 'XMLHttpRequest' == ( $this->server('HTTP_X_REQUESTED_WITH') ?? '' );
	}

	//SETTERS

	/**
	 * @param $get
	 * @return $this
	 */
	public function setGet($get) {$this->get = $get; return $this; }

	/**
	 * @param $post
	 * @return $this
	 */
	public function setPost($post) {$this->post = $post; return $this; }

	/**
	 * @param $request
	 * @return $this
	 */
	public function setRequest($request) {$this->request = $request; return $this; }

	/**
	 * @param $server
	 * @return $this
	 */
	public function setServer($server) {$this->server = $server; return $this; }

	/**
	 * @param $session
	 * @return $this
	 */
	public function setSession($session) {$this->session = $session; return $this; }

	/**
	 * @param $cookie
	 * @return $this
	 */
	public function setCookie($cookie) {$this->cookie = $cookie; return $this; }

	/**
	 * @param $files
	 * @return $this
	 */
	public function setFiles($files) {$this->files = $files; return $this; }

	/**
	 * @param $input
	 * @return $this
	 */
	public function setInput($input) {$this->input = $input; return $this;}

	/**
	 * @param $domain
	 * @return $this
	 */
	public function setDomain($domain) {$this->domain = $domain; return $this;}

	/**
	 * @param string $url
	 * @return Request
	 */
	public function setUrl($url) {$this->url = $url; return $this;}

	/**
	 * @param $guid
	 * @return $this
	 */
	public function setGUID($guid) {$this->guid = $guid; return $this;}

	/**
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function setCache($key,$value) {$this->cache[$key] = $value; return $this;}

	//PROTECTED

	/**
	 * @param $array array
	 * @param $key string
	 * @return mixed
	 */
	protected function getValueByKey($array, $key) {
		// $key = 'rules/10/item';
		$key_array = explode('/', $key);
		if (isset($this->$array[$key_array[0]]))
			$x = $this->$array[$key_array[0]];
		else
			return NULL;
		for ($i = 1; $i < count($key_array); $i++)
			if (isset ($x[$key_array[$i]]))
				$x = $x[$key_array[$i]];
			else
				return NULL;
		return $x;
	}
}