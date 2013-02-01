<?php
/*
 * @auther lion
 * @date 2013-2-1
 */
class GoodsCategory{
	private $id;
	private $goods_category_name;
	private $created;
	private $modified;
	public function __construct($id,$goods_category_name){
		$this->id=$id;
		$this->goods_category_name=$goods_category_name;
	}	
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}
?>