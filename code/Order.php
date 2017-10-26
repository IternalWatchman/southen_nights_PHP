<?php
/**
 * Order class | code/Order.php
 *
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex;

use Lex\Product;
use Lex\Customer;
/**
 * Class Order
 */
class Order {
	/**
    * Array of order products
    * @access private
    */
	private $products = [];
	/**
     * Constructor
     * @param  string id
     * @param  Customer customer
     * @param  string total
     * @return void
     */
	public function __construct($id, Customer $customer, $total) {
		$this->id = $id;
		$this->customer = $customer;
		$this->total = $total;
	}
	/**
	 * Order id
     * @return int|string could be an int, could be a string
     */
	public function id() {
		return $this->id;
	}
	/**
	 * Order customer instance
     * @return Customer
     */
	public function customer() {
		return $this->customer;
	}
	/**
	 * Order total
     * @return int|string could be an int, could be a string
     */
	public function total() {
		return $this->total;
	}
	/**
	 * Get order products instances
     * @return array 
     */
	public function products() {
		return $this->products;
	}
	/**
	 * Add product instance to order
	 * @param  Product
     * @return void
     */
	public function addProduct(Product $product) {
		if ($product->quantity())
			array_push($this->products, $product);
	}
}
