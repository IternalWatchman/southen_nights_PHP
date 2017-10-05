<?php
/**
 * Customer class | code/Customer.php
 *
 * @author Kauperwood <norepy@gmail.com.com>
 */
namespace Lex;
/**
 * Class Customer
 */
class Customer {
	/**
     * Constructor
     * @param  string id
     * @param  string title
     * @param  string revenue
     * @return void
     */
	public function __construct($id, $name, $revenue) {
		$this->id = $id;
		$this->name = $name;
		$this->revenue = $revenue;
	}
	/**
     * get customer id
     * @return string id
     */
	public function id() {
		return $this->id;
	}
	/**
     * get customer name
     * @return string
     */
	public function name() {
		return $this->name;
	}
	/**
     * get customer revenue
     * @return string
     */
	public function revenue() {
		return $this->revenue;
	}

}