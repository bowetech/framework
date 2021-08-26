<?php

declare(strict_types=1);

namespace Intelligent\Contracts\Kernel;

interface Kernel
{

	/**
	 * Handle an incoming HTTP request.
	 *
	 * @param   $request
	 * @return  Response
	 */
	public function handle($request);
}
