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
		$this->validate($request, [
			'id' => 'required|integer',
			'customer-id' => 'required|integer',
			'items' => ['required', 'array', new ValidItems],
			'items.*.product-id' => 'required|alpha_num',
			'items.*.quantity' => 'required|integer',
			'total' => 'required|regex:/^[1-9][0-9]*(\.\d{1,2})?$/'
		]);

		$this->validate($request, [
			'id' => [new ValidOrder],           
		]);

		$this->validate($request, [
			'customer-id' => [new ValidCustomer],           
			'items.*.product-id' => [new ValidProduct],
		]);
		
		return $next($request);
	}
}