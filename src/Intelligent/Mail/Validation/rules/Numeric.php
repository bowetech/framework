<?php

namespace Intelligent\Mail\Validation\rules;

use  Intelligent\Mail\Validation\ValidationInterface;

class Numeric implements ValidationInterface
{
	protected $value, $name;

	public function __construct($value, $name)
	{
		$this->value = $value;
		$this->name = $name;
	}

	public function validate(): string
	{
		if (!is_numeric($this->value)) {
			return 	"$this->name field requires a number.";
		}

		return '';
	}
}
