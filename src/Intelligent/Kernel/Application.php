<?php

namespace Intelligent\Kernel;

use Intelligent\Contracts\Provider\ServiceProvider as ServiceContract;
use Intelligent\Support\Providers\RouterServiceProvider;

class Application extends Container
{
	/**
	 * The Static framework version.
	 *
	 * @var String
	 */
	const VERSION = '0.0.x';

	const DIRECTORY_SEPARATOR = "/";

	/**
	 * The base path for the Static installation.
	 *
	 * @var string
	 */
	protected $basePath;

	/**
	 * The custom application path defined by the developer.
	 *
	 * @var string
	 */
	protected $appPath;

	/**
	 * The names of the loaded service providers..
	 *
	 * @var array
	 */
	protected  $loadedProviders = [];

	/**
	 * The base path for the Static installation.
	 *
	 * @var string
	 */
	public function __construct($basePath = null)
	{

		if ($basePath) {
			$this->setBasePath($basePath);
		}

		$this->registerBaseBindings();
		$this->registerBaseServiceProviders();
		$this->registerCoreContainerAliases();
	}

	/**
	 * Register services and start main the application services.
	 * @return void
	 */
	public function run()
	{
		//echo "<pre>";
		//print_r($this);
	}
	/**
	 * Get the version number of the application.
	 *
	 * @return String
	 */
	public function version()
	{
		return static::VERSION;
	}

	/**
	 * The base path for the Static installation.
	 *
	 * @var string
	 */
	public function setBasePath($basePath)
	{
		$this->basePath = rtrim($basePath, '\/');

		$this->bindPathsInContainer();

		return $this;
	}

	/**
	 * Bind all of the application paths in the container.
	 *
	 * @return void
	 */
	protected function bindPathsInContainer()
	{
		$this->instance('path', $this->path());
		$this->instance('path.base', $this->basePath());
		$this->instance('path.config', $this->configPath());
		$this->instance('path.resources', $this->resourcePath());
		$this->instance('path.views', $this->resourcePath('views'));
		$this->instance('path.routes', $this->routePath('web.php'));
	}

	/**
	 * Get the path to the application "app" directory.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function path(string $path = ''): string
	{
		$appPath = $this->appPath ?: $this->basePath . DIRECTORY_SEPARATOR . 'app';

		return $appPath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	/**
	 * Get the base path of the Framework installation.
	 *
	 * @param  string  $path Optionally, a path to append to the base path
	 * @return string
	 */
	public function basePath(string $path = ''): string
	{

		return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	/**
	 * Get the path to the application configuration files.
	 *
	 * @param  string  $path Optionally, a path to append to the config path
	 * @return string
	 */
	public function configPath(string $path = ''): string
	{

		return $this->basePath . DIRECTORY_SEPARATOR . 'config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}


	/**
	 * Get the path to the resources directory.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function resourcePath(string $path = ''): string
	{

		return $this->basePath . DIRECTORY_SEPARATOR . 'resources' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}



	/**
	 * Get the path to the routes directory.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function routePath(string $path = ''): string
	{

		return $this->basePath . DIRECTORY_SEPARATOR . 'routes' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}




	/**
	 * Register the basic bindings into the container.
	 *
	 * @return void
	 */
	public function registerBaseBindings()
	{
		static::setInstance($this);
		$this->instance('app', $this);
		$this->instance(Container::class, $this);

		$this->instance('router', Router::class);
	}

	/**
	 * Register all of the base service providers.
	 *
	 * @return void
	 */
	public function registerBaseServiceProviders()
	{
		$this->register(new RouterServiceProvider($this));
	}

	/**
	 * Register the core class aliases in the container.
	 *
	 * @return void
	 */
	public function registerCoreContainerAliases()
	{
		foreach ([
			'app'                  => [self::class, \Intelligent\Kernel\Container::class],
			'router'               => [\Intelligent\Kernel\Router::class],

		] as $key => $aliases) {
			foreach ($aliases as $alias) {
				$this->alias($key, $alias);
			}
		}
	}

	/**
	 * Register Providers of the base service providers.
	 *
	 * @return void
	 */
	public function register(ServiceContract $provider)
	{
		if (!$this->providerHasBeenLoaded($provider)) {
			$provider->register($this);

			$this->loadedProviders[] = get_class($provider);
		}

		return $this;
	}

	/**
	 * Check if Providers service has been loaded.
	 *
	 * @return  boolean 
	 */
	protected function providerHasBeenLoaded(ServiceContract $provider)
	{
		return array_key_exists(get_class($provider), $this->loadedProviders);
	}

	public function getBasePath()
	{
		return $this->basePath;
	}
}
