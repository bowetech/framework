<?php

namespace Intelligent\Mail\Validation;

interface ValidationInterface
{
	public function __construct(string $value, string $name);

	public function validate(): string;
}
