<?php
/*
 * @auther lion
 * @date 2013-2-4
 */
class Order{
	private $id;
	private $order_number;
	private $supplier_id;
	private $supplier_name;
	private $status;
	private $note;
	private $modified;
	private $created;
	public function __construct($id,$order_number,$supplier_id,$status,$note){
		$this->id=$id;
		$this->order_number=$order_number;
		$this->supplier_id=$supplier_id;
		$this->status=$status;
		$this->note=$note;
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}	
}
?>