<?php 
/**
 * Discount rule two. | code/rules/RuleOne.php
 * 
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;
/**
 * For every products of category 'Switches' (id 2), when you buy five, you get a sixth for free.
 */
class RuleTwo implements Rule {
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
	public function test(Order $order) {
		return count(array_filter($order->products(), function($item) {
			return $item->category() == 2 && $item->quantity() >= 5;
		})) > 0;
	}
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
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