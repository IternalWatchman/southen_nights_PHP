<?php 
/**
 * Discount rule three. | code/rules/RuleOne.php
 * 
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex\Rules;

use Lex\Rule;
use Lex\Order;
/**
 * If you buy two or more products of category 'Tools' (id 1), ou get a 20% discount on the cheapest product.
 */
class RuleThree implements Rule {
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
	public function test(Order $order) {
		$quantity = 0;
		foreach($order->products() as $item) {
			if($item->category() == 1) {
				$quantity += $item->quantity();
			}
		}
		return $quantity >= 2;
	}
	/**
	 * {@inheritDoc}
	 * @param $order
	 */
	public function calc(Order $order) {
		$prices = array();
		foreach($order->products() as $item) {
			if($item->category() == 1)
				array_push($prices, $item->price());
		}

		$minimum = min($prices);
		return array(
			'discount' => $minimum * .20,
			'description' => "If you buy two or more products of category 'Tools' (id 1), ou get a 20% discount on the cheapest product."
		);
	}
}