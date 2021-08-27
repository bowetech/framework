<?php

namespace Intelligent\Kernel;

use Intelligent\Kernel;


class View
{
	public static function render($template, $args = [])
	{
		static $twig = null;

		if ($twig === null) {

			$loader = new \Twig\Loader\FilesystemLoader(resource_path('views'));
			$twig = new \Twig\Environment($loader, [
				'cache' =>  base_path('cache'),
			]);
		}

		echo $twig->render($template, $args);
	}
}
