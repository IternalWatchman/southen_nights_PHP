<?php 

namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;

class RuleTwo implements Rule {
	public function test(Order $order) {
		return false;

	}
	public function calc(Order $order) {
		return false;
	}
}