<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
class SupplierCategory{
	private $id;
	private $supplier_category_name;	
	private $created;
	private $modified;
	public function __construct($id,$supplier_category_name){
		$this->id=$id;
		$this->supplier_category_name=$supplier_category_name;		
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}