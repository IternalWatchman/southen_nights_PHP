<?php

namespace Lex\Validation;

use Lex\Watchman;
use Illuminate\Contracts\Validation\Rule;

class Order extends Watchman implements Rule {
	public function passes($attribute, $value) {
		return $this->search('order', $value);
	}
	public function message() {
		return 'Order not found.';
	}
}
