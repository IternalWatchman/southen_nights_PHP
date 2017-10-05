<?php 
/**
 * Discount rule one. | code/rules/RuleOne.php
 * 
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;
/**
 * A customer who has already bought for over 1000 euro, gets a discount of 10% on the whole order. 
 */
class RuleOne implements Rule {
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
	public function test(Order $order) {
		return $order->customer()->revenue() > 1000;
	}
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
	public function calc(Order $order) {
		return [
			'discount' => ($order->total() / 100) * 10,
			'description' => "A customer who has already bought for over 1000 euro, gets a discount of 10% on the whole order."
		];
	}
}