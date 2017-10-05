<?php 
/**
 * Watchman | code/Customer.php
 *
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex;

use Lex\Customer;
use Lex\Product;
use Lex\Order;
/**
 * Managment class for orders.
 */
class Watchman {
	/**
    * Pathes for json files
    * @access private
    */
	private $sources =  [
		'product' => './data/products.json',
		'order'   => './data/orders.json',
		'customer'=> './data/customers.json'
	];

	/**
     * Search in some file by id
     * @param  string type of file
     * @param  int|strin entity id
     * @access private
     * @return array|bool
     */
	private function search($type, $entity_id) {
		$jsondata = file_get_contents($this->sources[$type]);
		$array = json_decode($jsondata, true);
		$result = false;
		foreach($array as $value) 
			if($value['id'] == $entity_id)
				$result = $value;
		return $result;
	}
	/**
	 * Get product instance
	 * @param  string product id
     * @return Product|bool
     */
	public function findProduct($id) {
		$d = $this->search('product', $id);
		return $data ? new Product($d['id'], $d['category'], $d['price'], $d['description']) : false;
	}
	/**
	 * Get customer instance
	 * @param  int|string customer id
     * @return Customer|bool
     */
	public function findCustomer($id) {
		$d = $this->search('customer', $id);
		return $d ? new Customer($d['id'], $d['name'], $d['revenue']) : false;
	}
	/**
	 * Get customer instance
	 * @param  int|string customer id
     * @return Order|bool
     */
	public function findOrder($id) {
		$d = $this->search('order', $id);
		if ($d) {
			$order = new Order($d['id'], $this->findCustomer($d['customer-id']), $d['total']);
			foreach($d['items'] as $item) {
				$product = $this->search('product', $item['product-id']);
				if($product) {
					$order->addProduct(
						new Product(
							$product['id'], 
							$product['category'], 
							$product['price'],
							$product['description'],
							$item['quantity'],
							$item['total']
						)
					);
				}
			}
			return $order;
		}
	}
}