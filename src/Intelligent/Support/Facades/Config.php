<?php

declare(strict_types=1);

namespace Intelligent\Support\Facades;

use Intelligent\Contracts\Facade\Facade;

/**
 *  Get the registered name of the component 
 * 
 * @return  string returns the name of the class
 */
class Config extends Facade
{
	protected static function getFacadeAccessor()
	{
		return app()->resolve('config');
	}
}
