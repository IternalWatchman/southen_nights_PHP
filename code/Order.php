<?php

namespace Lex;

use Lex\Product;
use Lex\Customer;

class Order {

	private $products = [];

	public function __construct($id, Customer $customer, $total) {
		$this->id = $id;
		$this->customer = $customer;
		$this->total = $total;
	}

	public function id() {
		return $this->id;
	}

	public function customer() {
		return $this->customer;
	}

	public function total() {
		return $this->total;
	}

	public function products() {
		return $this->products;
	}

	public function addProduct(Product $product) {
		array_push($this->products, $product);
	}

}