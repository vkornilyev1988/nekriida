<?php


namespace Nekrida\Core\Interfaces;


interface RouteLoaderInterface
{
	/**
	 * @param array $parameters Config parameters for the loader
	 */
	public static function load($parameters);
}