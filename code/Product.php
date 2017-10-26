<?php
/**
 * Product class | code/Product.php
 *
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex;
/**
 * Class Product
 */
class Product {
	/**
     * Constructor
     * @param  string id
     * @param  string category id
     * @param  string price
     * @param  string description
     * @param  string qunatity
     * @param  string total
     * @return void
     */
	public function __construct($id, $category_id, $price, $description, $quantity=null, $total=null) {
		$this->id = $id;
		$this->category = $category_id;
		$this->price = $price;
		$this->description = $description;
		$this->quantity = $quantity;
		$this->total = $total;
	}
	/**
	 * Get product id
     * @return int|string could be an int, could be a string
     */
	public function id() {
		return $this->id;
	}
	/**
	 * Get product category id
     * @return int|string could be an int, could be a string
     */
	public function category() {
		return $this->category;
	}
	/**
	 * Get product price
     * @return int|string could be an int, could be a string
     */
	public function price() {
		return $this->price;
	}
	/**
	 * Get product description
     * @return int|string could be an int, could be a string
     */
	public function description() {
		return $this->description;
	}
	/**
	 * Get product quantity
     * @return int|string could be an int, could be a string
     */
	public function quantity() {
		return $this->quantity;
	}
	/**
	 * Get product total
     * @return int|string could be an int, could be a string
     */
	public function total() {
		return $this->total;
	}

}