<?php 

namespace Lex;

use Lex\Order;

interface Rule {
	public function test(Order $order);
	public function calc(Order $order);
}