<?php

namespace Lex\Validation;

use Lex\Watchman;
use Illuminate\Contracts\Validation\Rule;

class Items implements Rule {
	public function passes($attribute, $value) {
		return is_array($value) && count($value) > 0;
	}
	public function message() {
		return 'Invalid data. Order items must be an array & contains at least one element';
	}
}
