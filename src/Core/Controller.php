<?php


namespace Nekrida\Core;

/**
 * Class Controller
 * @package Nekrida\Core
 */
abstract class Controller
{
	/** @var Request  */
	protected $request;
	/** @var Response  */
	protected $response;

	/**
	 * Controller constructor.
	 * @param Request $request
	 */
	function __construct(Request $request) {
		$this->request = $request;
		$this->response = new Response($this->request);
	}

}