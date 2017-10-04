<?php

namespace Lex;

class Product {

	public function __construct($id, $category_id, $price, $description, $quantity, $total) {
		$this->id = $id;
		$this->category = $category_id;
		$this->price = $price;
		$this->description = $description;
		$this->quantity = $quantity;
		$this->total = $total;
	}

	public function id() {
		return $this->id;
	}

	public function category() {
		return $this->category;
	}

	public function price() {
		return $this->price;
	}

	public function description() {
		return $this->description;
	}

	public function quantity() {
		return $this->quantity;
	}

	public function total() {
		return $this->total;
	}

}