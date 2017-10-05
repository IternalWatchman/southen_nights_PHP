<?php 
/**
 * Discount rule | code/Rule.php
 *
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex;

use Lex\Order;
/**
 * Rules interface 
 */
interface Rule {
	/**
	 * Test if order can have a discount
	 * @param Order $order
	 * return bool
	 */
	public function test(Order $order);
	/**
	 * Calculate order discount case
	 * @param Order $order
	 * return array
	 */
	public function calc(Order $order);
}