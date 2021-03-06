<?php

use Intelligent\Kernel\Env;
use  Intelligent\Kernel\Container;

/**
 * Get the available container instance.
 *
 * @param  string|null  $abstract
 * @param  array   $parameters
 * @return mixed|\Kernel\Application
 */
if (!function_exists('app')) {
	function app($abstract = null, array $parameters = [])
	{
		if (is_null($abstract)) {

			return Container::getInstance();
		}

		return Container::getInstance()->make($abstract, $parameters);
	}
}

/**
 * Converts string to StudlyCaps and removes hypens
 * 
 * @param string $string The string to convert
 * @return string in StudlyCaps
 */
if (!function_exists('convertToStudlyCaps')) {
	function convertToStudlyCaps($string)
	{
		return str_replace('-', '', ucwords($string, '-'));
	}
}

/**
 * Converts string to camelCase and removes hypens
 * 
 * @param string $string The string to convert
 * @return string in camelCase
 */
if (!function_exists('convertToCamelCase')) {
	function convertToCamelCase($string)
	{
		return  lcfirst(convertToStudlyCaps($string));
	}

	/**
	 * Get Environmental.
	 *
	 * @param  string  $key
	 * @param  string |null $default
	 * @return mixed 
	 */
	if (!function_exists('env')) {

		function env($key, $default = null)
		{
			return Env::get($key, $default);
		}
	}



	if (!function_exists('config_path')) {
		/**
		 * Get the configuration path.
		 *
		 * @param  string $path
		 * @return string
		 */
		function config_path($path = '')
		{
			return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
		}
	}


	if (!function_exists('resource_path')) {
		/**
		 * Get the configuration path.
		 *
		 * @param  string $path
		 * @return string
		 */
		function resource_path($path = '')
		{
			return app()->basePath() . '/resources' . ($path ? '/' . $path : $path);
		}
	}

	if (!function_exists('base_path')) {
		/**
		 * Get the application base path.
		 *
		 * @param  string $path
		 * @return string
		 */
		function base_path($path = '')
		{
			return app()->basePath() . ($path ? '/' . $path : $path);
		}
	}
}
