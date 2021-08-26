<?php

declare(strict_types=1);

namespace Intelligent\Kernel;

class Env
{
	/**
	 * Gets the value of an environment variable.
	 *
	 * @param  string  $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	public static function get($key, $default = null)
	{
		$value = isset($_ENV[$key]) ? $_ENV[$key] : $default;

		switch ($value) {
			case null:
			case '':
				return $default;
			case strtolower('true'):
			case strtolower('(true)'):
				return true;
			case strtolower('false'):
			case strtolower('(false)'):
				return false;
			case strtolower('empty'):
			case strtolower('(empty)'):
				return '';
			case strtolower('null'):
			case strtolower('(null)'):
				return $default;
		}

		return $value;
	}
}
