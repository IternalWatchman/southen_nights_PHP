<?php

class ServiceTest extends TestCase
{

	public function testRequestMethod()
	{
		$json = [];
		$this->json('POST', '/calculate', $json)
			->seeJson([
			"status" => 400,
			"message" => "invalid JSON"
		]);

		$this->json('PUT', '/calculate', $json)
			->seeJson([
			"error" => [
				"message" => "Method Not Allowed",
				"status" => 405
			]
		]);

		$this->json('DELETE', '/calculate', $json)
			->seeJson([
			"error" => [
				"message" => "Method Not Allowed",
				"status" => 405
			]
		]);

		$this->json('GET', '/calculate', $json)
			->seeJson([
			"error" => [
				"message" => "Method Not Allowed",
				"status" => 405
			]
		]);
	}

	public function testWrongJSON1() {
		$json = [
			"id" => "1",
			"customer-id" => "3",
			"total" => "24.95"
		];

		$this->json('POST', '/calculate', $json)
			->seeJson([
				"status" => 422,
				"message" => "invalid input data",
				"errors" => [
					"items" => [
						[
							"type" => "required",
							"message" => "The items field is required."
						]
					]
				]
		]);
	}

	public function testWrongJSON2() {

		$json = [
			"id" => "1",
			"total" => "00.00",
			"items" => [
				[
					"quantity" => "2",
					"unit-price" => "9.75",
					"total" => "19.50"
				],
				[
					"product-id" => "A102",
					"unit-price" => "9.75",
					"total" => "19.50"
				]
			]
		];

		$this->json('POST', '/calculate', $json)
			->seeJson([
				"status" => 422,
				"message" => "invalid input data",
				"errors" => [
					"customer-id" => [
						[
							"type" => "required",
							"message" => "The customer-id field is required."
						]
					],
					"total" => [
						[
							"type" => "regex",
							"message" => "The total format is invalid."
						]
					],
					"items.0.product-id" => [
						[
							"type" => "required",
							"message" => "The items.0.product-id field is required."
						]
					],
					"items.1.quantity" => [
						[
							"type" => "required",
							"message" => "The items.1.quantity field is required."
						]
					]
				]
		]);
	}

	public function testNoneExistingPost() {
		$json = [
			"id" => "142242",
			"customer-id" => "3",
			"total" => "20.00",
			"items" => [
				[
					"product-id" => "A102",
					"quantity" => "2",
					"unit-price" => "9.75",
					"total" => "19.50"
				],
				[
					"product-id" => "A101",
					"quantity" => "2",
					"unit-price" => "19.75",
					"total" => "19.50"
				]
			]
		];

		$this->json('POST', '/calculate', $json)
			->seeJson([
			"status" => 422,
			"message" => "invalid input data",
			"errors" => [
				"id" => [
					"Order not found."
				]
			]
		]);
	}
}
