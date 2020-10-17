<?php


namespace Nekrida\Core;


class Middleware
{
	/** @var Request */
	protected $request;

	function __construct(Request $request) {
		$this->request = $request;
	}
}