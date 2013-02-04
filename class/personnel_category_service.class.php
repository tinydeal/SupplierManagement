<?php
class PersonnelCategoryService{
	private $g_db;
	public function __construct(){
		require_once './class/personnel_category.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_personnel_category"){

		$sql=$sql." order by id desc";
		$array_personnel_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_personnel_category;
	}
	
	public function getListRows($sql="select count(*) from t_personnel_category"){
		return $this->g_db->getRows($sql);
	}
	
	public function addPersonnelCategory($personnel_category){
		$personnel_category_name=$personnel_category->_get('personnel_category_name');
		$permission_name=$personnel_category->_get('permission_name');
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_personnel_category  (personnel_category_name,permission_name,created)  values ('%s','%s','%s')",$personnel_category_name,$permission_name,$created);
		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public function getPersonnelCategoryById($id){
		$sql=sprintf("select * from t_personnel_category where id=%d",$id);
		return $this->g_db->getOne($sql);
	}
	
	public function updatePersonnelCategory($personnel_category){
		$id=$personnel_category->_get('id');
		$personnel_category_name=$personnel_category->_get('personnel_category_name');
		$permission_name=$personnel_category->_get('permission_name');
		$sql=sprintf("update t_personnel_category set personnel_category_name='%s',permission_name='%s' where id=%d",$personnel_category_name,$permission_name,$id);
		return $this->g_db->Execute($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_personnel_category where concat (personnel_category_name , permission_name ) like "){
		$keywords=strtr($keywords, CodeNames::$permission_search_replace); 
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by id desc";
		$array_personnel_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_personnel_category;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_personnel_category where concat (personnel_category_name , permission_name ) like "){
		$keywords=strtr($keywords, CodeNames::$permission_search_replace); 
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	
	public  function getAll($sql="select * from t_personnel_category"){

		$sql=$sql." order by id desc";
		$array_personnel_category=$this->g_db->getAllDate($sql);
		return $array_personnel_category;
	}

}