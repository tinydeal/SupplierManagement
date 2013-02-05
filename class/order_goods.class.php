<?php
/*
 * @auther lion
 * @date 2013-2-4
 *
 */ 
class OrderGoods{
	private $id;
	private $order_id;
	private $goods_id;
	private $goods_name;
	private $goods_number;
	private $system_number;
	private $status;
	private $note;
	public function __construct($id,$order_id,$goods_id,$goods_name,$goods_number,$status,$note){
		$this->id=$id;
		$this->order_id=$order_id;
		$this->goods_id=$goods_id;
		$this->
		$this->goods_number=$goods_number;
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