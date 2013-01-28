<?php
class PersonnelCategoryService{
	private $g_db;
	public function __construct(){
		require_once './class/personnel_category.class.php';
		require_once './class/database.class.php';
	}
	public  function listAll($sql="select * from personnel_category"){
		$this->g_db=Database::getInstance();
		$array_personnel_category=$this->g_db->getAll($sql);
		return $array_personnel_category;
	}
}