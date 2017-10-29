<?php 

namespace Lex\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lex\Validation\Product as ValidProduct;
use Lex\Validation\Order as ValidOrder;
use Lex\Validation\Customer as ValidCustomer;
use Lex\Validation\Items as ValidItems;

use Lex\Watchman;
use Lex\Order;
use Lex\Product;
use Lex\Customer;

use Validator;

class Discount extends Controller 
{

	public function get(Request $request, $order_id) {

		$validator = Validator::make(['order' => $order_id], [
			'order' => [new ValidOrder]
		]);
		
		if($validator->fails()) {
			return response()->json(
				array(
					'status' => 422,
					'message' => 'invalid input data',
					'errors' => $validator->messages()
				), 422);
		}

		$watchman = new Watchman();
		$order = $watchman->findOrder($order_id);

		return $this->calculateDiscount($order);
	}

	public function post(Request $request) {
		$p = $request->post();
		$id = (int) $p['id'];
		$customer_id = (int) $p['customer-id'];
		$items = $p['items'];

		$watchman = new Watchman();
		$customer = $watchman->findCustomer($customer_id);
		$order = new Order($id, $customer, $p['total']);

		foreach($items as $item) {
			$product = $watchman->findProduct($item['product-id']);
			$quantity = (int) $item['quantity'];
			$order->addProduct(
				new Product(
					$product->id(), 
					$product->category(), 
					$product->price(),
					$product->description(),
					$quantity,
					$product->price() * $quantity 
				)
			);
		}

		return  $this->calculateDiscount($order);
	}

	private function calculateDiscount(Order $order) {

		$rules = [
			new \Lex\Rules\RuleOne(),
			new \Lex\Rules\RuleTwo(),
			new \Lex\Rules\RuleThree()
		];

		$discounts = array();

		foreach($rules as $rule)
			if($rule->test($order)) 
				array_push($discounts, $rule->calc($order));

		return response()->json([
			'status' => 200,
			'message' => 'OK',
			'discounts' => $discounts
		]);
	}
}