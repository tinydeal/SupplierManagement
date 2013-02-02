<?php
/*
 * @auther lion
 * @date 2013-2-2
 */
class Problem{
	private $id;
	private $problem_name_category;
	private $supplier_id;
	private $supplier_name;
	private $description;
	private $note;
	private $created;
	private $modified;
	public function __construct($id,$problem_name_category,$supplier_id,$description,$note){
		$this->id=$id;
		$this->problem_name_category=$problem_name_category;
		$this->supplier_id=$supplier_id;
		$this->description=$description;
		$this->note=$note;
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}