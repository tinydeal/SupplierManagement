<?php
class PersonnelCategory{
	private $id;
	private $category_name;
	private $permission_name;
	private $scrq;
	public function __construct($id,$category_name,$permission_name){
		$this->id=$id;
		$this->category_name=$category_name;
		$this->permission_name=$permission_name;
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}