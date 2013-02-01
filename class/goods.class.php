<?php
/*
 * @auther lion	
 * @date 2013-2-1
 */
class Goods{
	private $id;
	private $goods_name;
	private $goods_category_id;
	private $goods_category_name;
	private $system_number;
	private $price;
	private $size;
	private $color;
	private $description;
	private $website;
	private $note;
	private $created;
	private $modified;
	public function __construct($id,$goods_name,$goods_category_id,$system_number,$price,$size,$color,$description,$website,$note){
		$this->id=$id;
		$this->goods_name=$goods_name;
		$this->goods_category_id=$goods_category_id;
		$this->system_number=$system_number;
		$this->price=$price;
		$this->size=$size;
		$this->color=$color;
		$this->description=$description;
		$this->website=$website;
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