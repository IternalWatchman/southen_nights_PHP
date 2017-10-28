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

		$this->json('GET', '/calculate', $json)
			->seeJson([
			"status" => 400,
			"message" => "invalid JSON"
		]);

		$this->json('PUT', '/calculate', $json)
			->seeJson([
			"status" => 400,
			"message" => "invalid JSON"
		]);

		$this->json('DELETE', '/calculate', $json)
			->seeJson([
			"status" => 400,
			"message" => "invalid JSON"
		]);
	}

	public function testRequestMethod() {}
}
