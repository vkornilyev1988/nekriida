<?php

namespace Nekrida\Responses;

use Nekrida\Core\Config;
use Nekrida\Core\Request;
use Nekrida\Core\Interfaces\ResponderInterface;

/**
 * Class NekroResponser
 * Loader for backward compatibility with previous versions of Nekrida
 */
class NekroResponder implements ResponderInterface
{
	/** @var Request */
	protected $request;

	protected $config;

	public function __construct(Request $request, array $config)
	{
		$this->request = $request;

		$this->config = $config;
	}

	public function render($view, array $parameters) {
		extract($parameters);

		$viewFile = $this->getView($view);
		//Include view
		ob_start();
		if ($viewFile)
			include $viewFile;
		$content = ob_get_clean();

		//Include layout if exists
		$layoutController = $this->config['layoutController'];
		if (class_exists($layoutController)) {
			$header = new $layoutController($this->request);
			$total = $header->header($content,$parameters)->getBody();
		} else {
			$total = $content;
		}

		return $total;
	}

	public function view($view, array $parameters = []) {
		extract($parameters);

		$viewFile = $this->getView($view);

		ob_start();
		if ($viewFile)
			include $viewFile;
		$total = ob_get_clean();

		return $total;
	}

	public function setLayoutController($controller) {
		$this->config['layoutController'] = $controller;
	}

	/**
	 * Get real path to the view
	 * @param $view
	 * @return mixed
	 */
	protected function getView($view) {
		foreach ($this->config['url'] as $url) {
			$uri = str_replace(['{root}','{view}'],[Config::root(),$view],$url);
			if (file_exists($uri))
				return $uri;
		}
		return null;
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
}