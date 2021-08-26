<?php

namespace Intelligent\Kernel;

use Intelligent\Kernel;


class View
{
	public static function render($template, $args = [])
	{
		static $twig = null;

		if ($twig === null) {
			$loader = new \Twig_Loader_Filesystem(app()->resolve('path.views'));
			$twig = new \Twig_Environment($loader);
		}

		echo $twig->render($template, $args);
	}
}
