<?php

namespace Nekrida\Core\Interfaces;

use Nekrida\Core\Request;

/**
 * Interface ResponserInterface
 */
interface ResponderInterface
{
	/**
	 * ResponserInterface constructor.
	 * @param Request $request
	 * @param array $config
	 */
	public function __construct(Request $request, array $config);

	/**
	 * Renders the page with header
	 * @param string $view
	 * @param array $parameters
	 * @return string
	 */
	public function render($view, array $parameters);

	/**
	 * Renders the page.
	 * @param string $view
	 * @param array $parameters
	 * @return mixed
	 */
	public function view($view, array $parameters);
}