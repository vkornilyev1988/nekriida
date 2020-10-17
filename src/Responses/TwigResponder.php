<?php

namespace Nekrida\Responses;

use Nekrida\Core\Config;
use Nekrida\Core\Request;
use Nekrida\Core\Interfaces\ResponderInterface;

class TwigResponder implements ResponderInterface
{
	protected $loader;

	protected $object;

	protected $fileSuffix = '';

	protected $request;

	public function __construct(Request $request, array $config) {
		$this->loader = new \Twig\Loader\FilesystemLoader(
			str_replace('{root}',Config::root(),$config['path'])
		);

		$this->object = new \Twig\Environment(
			$this->loader,
			$config['parameters']
			);

		$this->fileSuffix = isset($config['fileSuffix']) ? $config['fileSuffix'] : '';
	}

	public function render($view, array $parameters) {
		return $this->object->render($view . $this->fileSuffix, $parameters);
	}

	public function view($view, array $parameters) {
		return $this->object->render($view . $this->fileSuffix, $parameters);
	}
}