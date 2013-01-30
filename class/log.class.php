<?php
/*
 * @auther udzhou
 * @date 2013-1-30
 */
class Log{
	private $id;
	private $operation_msg;
	private $username;
	private $modified;
	private $created;
	public function __construct($id,$operation_msg,$username,$modified,$created){
		$this->id=$id;
		$this->operation_msg=$operation_msg;
		$this->username=$username;
		$this->modified=$modified;
		$this->created=$created;
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}
}