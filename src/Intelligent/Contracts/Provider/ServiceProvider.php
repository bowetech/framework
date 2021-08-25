<?php

declare(strict_types=1);

namespace Intelligent\Contracts\Provider;

use Intelligent\Kernel\Application;

interface ServiceProvider
{
	/**
	 * Register the services to Container.
	 * @param Application $app
	 * @return void
	 */
	public function __construct(Application $app);


	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register();
}
