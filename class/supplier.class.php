<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
class Supplier{
	private $id;
	private $supplier_name;
	private $supplier_category_id;
	private $wholesale_num_min;
	private $wholesale_num_max;
	private $goods_style;	
	private $goods_category;
	private $is_provide_pictures;
	private $website;
	private $linkman;
	private $telephone;
	private $province;
	private $city;
	private $village;
	private $address_detial;
	private $note;
	private $created;
	private $modified;
	public function __construct($id,$supplier_name,$supplier_category_id,$wholesale_num_min,$wholesale_num_max,$goods_style,$goods_category,$is_provide_pictures,$website,$linkman,$telephone,$province,$city,$village,$address_detial,$note){
		$this->id=$id;
		$this->supplier_name=$supplier_name;
		$this->supplier_category_id=$supplier_category_id;
		$this->wholesale_num_min=$wholesale_num_min;
		$this->wholesale_num_max=$wholesale_num_max;
		$this->goods_style=$goods_style;
		$this->goods_category=$goods_category;		
		$this->is_provide_pictures=$is_provide_pictures;
		$this->website=$website;
		$this->linkman=$linkman;
		$this->telephone=$telephone;
		$this->province=$province;
		$this->city=$city;
		$this->village=$village;
		$this->address_detial=$address_detial;
		$this->note=$note;		
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}