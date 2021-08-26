<?php

namespace Intelligent\Kernel;

use Intelligent\Contracts\Kernel\Kernel as KernelContract;
use Intelligent\Support\Facades\Route;


class Kernel implements KernelContract
{
	/**
	 * Handle an incoming HTTP request.
	 * Perform any final actions for the request lifecycle
	 * 
	 * @param  \Kernel\Request $request 
	 * @return  void
	 */
	public function handle($request)
	{
		Route::dispatcher($request);
	}
}
