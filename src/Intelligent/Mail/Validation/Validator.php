<?php

namespace Intelligent\Mail\Validation;

use Intelligent\Mail\Validation\Validate;

class Validator
{
	public static function validate($request)
	{
		$errors = [];

		foreach ($request as $field) {

			$rules = explode('|', $field['rules']);

			foreach ($rules as $key => $rule) {
				$error = '';
				$class = 'Intelligent\Mail\Validation\rules\\' . ucwords($rule);
				$error = (new Validate(new $class($field['value'], $field['name'])))->validate();

				if ($error) {
					$errors[$field['name']]['errors'][] = $error;
				}
			}
		}

		return $errors;
	}
}
