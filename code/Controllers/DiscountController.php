<?php 


namespace Lex\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Lex\Watchman;
use Lex\Order;
use Lex\Product;
use Lex\Customer;

class DiscountController extends Controller 
{
	public function index(Request $request, $id) {}

	public function calculate(Request $request) {

		$post =  $request->post();
		$id = (int) $post['id'];
		$customer_id = (int) $post['customer-id'];
		$items = $post['items'];
		$total = (float) $post['total'];

		$watchman = new Watchman();
		$customer = $watchman->findCustomer($customer_id);
		$order = new Order($id, $customer, $total);
		
		foreach($items as $item) {
			$product = $watchman->findProduct($item['product-id']);
			$quantity = (int) $item['quantity'];

			if ($quantity)
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

		$rules = [
			new \Lex\Rules\RuleOne(),
			new \Lex\Rules\RuleTwo(),
			new \Lex\Rules\RuleThree()
		];

		$discounts = array();

		foreach($rules as $rule)
			if($rule->test($order)) 
				array_push($discounts, $rule->calc($order));

		return response()->json($discounts);
	}
}