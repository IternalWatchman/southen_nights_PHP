<?php 

namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;

class RuleTwo implements Rule {
	public function test(Order $order) {
		return count(array_filter($order->products(), function($item) {
			return $item->category() == 2 && $item->quantity() >= 5;
		})) > 0;
	}
	public function calc(Order $order) {
		$items = array_filter($order->products(), function($item) {
			return $item->category() == 2 && $item->quantity() >= 5;
		});
		$discounts = array();
		foreach($items as $item) {
			array_push($discounts, array(
				'discount' => 'gift',
				'description' => "For every products of category 'Switches' (id 2), when you buy five, you get a sixth for free.",
				'product_id' => $item->id()
			));
		}
		return $discounts;
	}
}