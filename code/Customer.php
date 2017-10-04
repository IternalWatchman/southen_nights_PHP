<?php

namespace Lex;

class Customer {

	public function __construct($id, $name, $revenue) {
		$this->id = $id;
		$this->name = $name;
		$this->revenue = $revenue;
	}

	public function id() {
		return $this->id;
	}

	public function name() {
		return $this->name;
	}

	public function revenue() {
		return $this->revenue;
	}

}