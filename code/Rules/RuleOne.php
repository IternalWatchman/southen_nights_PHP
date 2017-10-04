<?php 

namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;

class RuleOne implements Rule {

	public function test(Order $order) {
		return $order->customer()->revenue() > 1000;
	}
	public function calc(Order $order) {
		return [
			'discount' => ($order->total() / 100) * 10,
			'description' => "A customer who has already bought for over 1000 euro, gets a discount of 10% on the whole order."
		];
	}
}