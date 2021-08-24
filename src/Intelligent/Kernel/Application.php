<?php

namespace Intelligent\Kernel;

use Intelligent\Kernel\Request;

class Application
{
	public Router $router;

	public function __construct()
	{
		$this->request = new Request();
		$this->router = new Router($this->request);
	}

	public function run()
	{
		$this->router->resolve();
	}
}
