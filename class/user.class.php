<?php
/*
 * @auther lion
 * @date 2013-1-30
 */
class User{
private $id;
private $name;
private $category_name_id;
private $category_name;
private $username;
private $pwd;
private $telephone;
private $email;
private $state;
private $note;
private $created;
private $modified;
public function __construct($id,$name,$category_name_id,$category_name,$username,$pwd,$telephone,$email,$state,$note){
	$this->id=$id;
	$this->name=$name;
	$this->category_name_id=$category_name_id;
	$this->category_name=$category_name;
	$this->username=$username;
	$this->pwd=$pwd;
	$this->telephone=$telephone;
	$this->email=$email;
	$this->state=$state;
	$this->note=$note;
	}
	public function _get($property_name){
		return $this->$property_name;
	}
	public function _set($property_name,$property_value){
		$this->$property_name=$property_value;
	}	
}