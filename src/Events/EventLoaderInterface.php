<?php
namespace Nekrida\Events;

interface EventLoaderInterface
{
	public static function load(EventDispatcher $dispatcher, array $config);
}