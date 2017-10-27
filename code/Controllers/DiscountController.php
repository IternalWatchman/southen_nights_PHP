<?php 


namespace Lex\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Lex\Watchman;
use Lex\Validation\Product as ValidProduct;
use Lex\Validation\Order as ValidOrder;
use Lex\Validation\Customer as ValidCustomer;

use Lex\Order;
use Lex\Product;
use Lex\Customer;

class DiscountController extends Controller 
{
	public function index(Request $request, $id) {}

	public function calculate(Request $request) {

		$this->validate($request, [
			'id' => 'required|integer',
			'customer-id' => [ 'required', 'integer'],
			'items' => ['required','array'],
			'items.*.product-id' => ['required', 'alpha_num'],
			'items.*.quantity' => 'required|integer',
			'total' => 'required|regex:/^[1-9][0-9]*(\.\d{1,2})?$/'
		]);
		// check if order are in 'dummy database'
		$this->validate($request, [
			'id' => [new ValidOrder],
		]);
			// check if customer and products are in 'dummy database'
		$this->validate($request, [
			'customer-id' => [new ValidCustomer],	    	
			'items.*.product-id' => [new ValidProduct],
		]);

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