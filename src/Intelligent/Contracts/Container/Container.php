<?php

namespace Intelligent\Contracts\Container;

interface Container
{

	/**
	 * Register a binding with the container.
	 *
	 * @param  string  $abstract
	 * @param  \Closure|string|null  $concrete
	 * @param  bool  $shared
	 * @return void
	 */

	public function bind($abstract, $concrete = null, $singleton = false);


	/**
	 * Register a shared binding in the container.
	 *
	 * @param  string  $abstract
	 * @param  \Closure|string|null  $concrete
	 * @return void
	 */
	public function singleton($abstract, $concrete);


	/**
	 *  Check if instance is a singleton 
	 * @param string $abstract
	 * @return  boolean | array binding 
	 */
	public function isSingleton($abstract);


	/**
	 * Get the container's bindings.
	 * @param string $key 
	 * @return array binding
	 */
	public function getBinding($key);


	/**
	 * Get the instance of a singleton if exsists.
	 * @param string $key 
	 * @return instance  singleton
	 */
	public function getSingletonInstance($key);

	/**
	 * Checks if the given key or index exists in the array.
	 * @param string $key 
	 * @return array  singleton
	 */
	public function singletonResolved($key);

	/**
	 * Resolve the given type from the container.
	 *
	 * @param  string  $abstract
	 * @param  array  $parameters
	 * @return mixed
	 *
	 * @throws  Error  if no success
	 */
	public function make($abstract, array $parameters = []);


	/**
	 * Get the alias for an abstract if available.
	 *
	 * @param  string  $abstract
	 * @return string
	 */
	public function getAlias($abstract);


	/**
	 * Resolve the given type from the container.
	 *
	 * @param  string  $abstract
	 * @param  array  $parameters
	 * @return mixed
	 */
	public function resolve($abstract,  $parameters = []);


	/**
	 * Build  Class dependence to supply to new instance of class
	 *
	 * @param  mixed  $class
	 * @param  array  $parameters
	 * @return object  $args
	 */
	public function buildObject($class, $parameters);

	/**
	 * Build  Class dependence to supply to new instance of class
	 *
	 * @param  object $parameters
	 * @param  mixed  $dependencies
	 * @param  mixed  $class
	 * @return mixed  $parameters	 *
	 */
	public function buildDependencies($parameters, $dependencies, $class);


	/**
	 * Register a binding as an instance in the container or retrun object.
	 *
	 * @param  string  $key
	 * @param  mixed   $object
	 * @return mixed
	 */
	public function buildInstance($key, $object);



	/**
	 * Register an existing instance as shared in the container.
	 *
	 * @param  string  $abstract
	 * @param  mixed   $instance
	 * @return mixed
	 */
	public function instance($abstract, $instance);


	/**
	 * Set the shared instance of the container.
	 *
	 * @param  Container\null  $container
	 * @return  Container\Container|static
	 */
	public static function setInstance(Container $container = null);


	/**
	 * Get the globally available instance of the container.
	 *
	 * @return static
	 */
	public static function getInstance();


	/**
	 * Alias a type to a different name.
	 *
	 * @param  string  $abstract
	 * @param  string  $alias
	 * @return void
	 *
	 * @throws \RuntimeException
	 */
	public function alias($abstract, $alias);

	/**
	 * ArrayAccess interface functions 
	 */

	/**
	 * Get the value at a given offset.
	 *
	 * @param  string  $key
	 * @return mixed
	 */

	public function offsetGet($key);

	/**
	 * Set the value at a given offset.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($key, $value);


	/**
	 * Determine if a given offset exists.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function offsetExists($key);


	/**
	 * Unset the value at a given offset.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function offsetUnset($key);
}
