<?php

declare(strict_types=1);

namespace Intelligent\Kernel;

use Symfony\Component\Finder\Finder;
use RuntimeException;

class Config
{
	/**
	 * Displays the Application Configuration value which are stored
	 * in the '\config' directory - each part represents an array
	 * dimension
	 *
	 * @param string $string containing "." separators
	 * @return string
	 */
	public static function get($string)
	{
		$config = self::getConfigs();

		$token  = strtok($string, '.');

		while ($token  !== false) {

			if (!isset($config[$token])) {
				return null;
			}

			$config = $config[$token];
			$token  = strtok('.');
		}

		return $config;
	}

	/**
	 * Loads All application and environment configuration information
	 * in the form of key => value pairs. This function looks though
	 * the '\config' directory for config files and adds them to the
	 * Global App array. Each file forms its own associative array.     *
	 *
	 * @param  void
	 * @return array $config  Associative array
	 */
	private static function getConfigs()
	{
		$finder = new Finder();

		$finder->files()->in(config_path());

		if ($finder->hasResults()) {

			foreach ($finder as $file) {
				$absoluteFilePath = $file->getRealPath();
				$fileNameWithExtension = $file->getRelativePathname();
				$filename = preg_replace('/.[^.]*$/', '', $fileNameWithExtension);
				$config[$filename] = include $absoluteFilePath;
			}
		}
		return $config;
	}
}
