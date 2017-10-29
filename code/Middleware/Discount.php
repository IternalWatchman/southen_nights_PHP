<?php

namespace Lex\Middleware;

use Closure;
use Exception;
use Validator;
use Lex\Validation\Product as ValidProduct;
use Lex\Validation\Order as ValidOrder;
use Lex\Validation\Customer as ValidCustomer;
use Lex\Validation\Items as ValidItems;
use Laravel\Lumen\Routing\Controller;

class Discount extends Controller
{
	/**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next) {

		$method = $request->method();

		if(empty($request->json()->all())) {
			throw new Exception('invalid JSON');
		}

		$validator1 = Validator::make($request->post(), [
	        'id' => 'required|integer',
			'customer-id' => 'required|integer',
			'items' => ['required', 'array', new ValidItems],
			'items.*.product-id' => 'required|alpha_num',
			'items.*.quantity' => 'required|integer',
			'total' => 'required|regex:/^[1-9][0-9]*(\.\d{1,2})?$/'
	    ]);

	    if ($validator1->fails())
		    return $this->jsonErrorsWithStatus($validator1);

		$validator2 = Validator::make($request->post(), [
			'id' => [new ValidOrder],           
		]);

		if ($validator2->fails())
			return $this->jsonErrorsWithStatus($validator2);

		$validator3 = Validator::make($request->post(), [
			'customer-id' => [new ValidCustomer],           
			'items.*.product-id' => [new ValidProduct],
		]);

		if ($validator3->fails())
			return $this->jsonErrorsWithStatus($validator3);

		return $next($request);
	}

	private function jsonErrorsWithStatus($validator) {
		return response()->json(
			array(
				'status' => 422,
				'message' => 'invalid input data',
				'errors' => $validator->messages()
			), 422);
	}
}