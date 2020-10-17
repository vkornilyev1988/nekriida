<?php


namespace Nekrida\Core\Interfaces;


interface DatabaseFactoryInterface
{
	public static function getInstance($config);
}