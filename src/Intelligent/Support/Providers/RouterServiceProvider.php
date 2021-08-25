<?php

namespace Intelligent\Support\Providers;

use Intelligent\Kernel\Router;
use Intelligent\Kernel\Application;
use Intelligent\Contracts\Provider\ServiceProvider as ServiceContract;


class RouterServiceProvider implements ServiceContract
{
	protected $app;

	public function __construct(Application $app)
	{
		$this->app = $app;

		$this->register();
	}

	/**
	 * Register router application services.
	 *
	 * @return void   
	 */
	public function register(): void
	{
		$this->app->singleton('router', Router::class);
	}
}
