<?php

use PHPUnit\Framework\TestCase;

function fetchCustomResult($order_id) {
	$discounts = array();
	$watchman = new Lex\Watchman();
	$order = $watchman->findOrder($order_id);
	foreach([ new Lex\Rules\RuleOne(), new Lex\Rules\RuleTwo(), new Lex\Rules\RuleThree() ] as $rule) {
		if($rule->test($order)) {
			array_push($discounts, $rule->calc($order));
		}
	}
	return $discounts;
}

class ServiceSimpleTest extends TestCase {

	public function testOrder() {
		$watchman = new Lex\Watchman();
		$order = $watchman->findOrder(2);
		$this->assertEquals($order->id(), 2);
		$this->assertEquals($order->customer()->id(), 2);
		$this->assertEquals($order->total(), 24.95);
		$this->assertEquals(count($order->products()), 1);
	}

	public function testCustomer() {
		$watchman = new Lex\Watchman();
		$customer = $watchman->findCustomer(2);
		$this->assertEquals($customer->name(), 'Teamleader');
		$this->assertEquals($customer->revenue(), 1505.95);
	}

	public function testProduct() {
		$watchman = new Lex\Watchman();
		$order = $watchman->findOrder(2);
		$product = $order->products()[0];
		$this->assertEquals($product->id(),'B102');
        $this->assertEquals($product->quantity(), 5);
        $this->assertEquals($product->price(), 4.99);
        $this->assertEquals($product->description(), 'Press button');
        $this->assertEquals($product->total(), 24.95);
	} 

	public function testDiscount1() {
		$result = fetchCustomResult(1);
		$this->assertEquals(count($result),1);
		$this->assertEquals($result[0][0]['discount'], 'gift');
		$this->assertEquals($result[0][0]['product_id'], 'B102');
	}

	public function testDiscount2() {
		$result = fetchCustomResult(2);
		$this->assertEquals(count($result),2);
		$this->assertEquals($result[0]['discount'], 2.495);
		$this->assertEquals($result[1][0]['discount'], 'gift');
		$this->assertEquals($result[1][0]['product_id'], 'B102');
	}

	public function testDiscount3() {
		$result = fetchCustomResult(3);
		$this->assertEquals(count($result),1);
		$this->assertEquals($result[0]['discount'], 1.95);
	}
}