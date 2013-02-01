<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
class SupplierCategoryService{
	private $g_db;
	public function __construct(){
		require_once './class/supplier_category.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_supplier_category"){

		$sql=$sql." order by id desc";
		$array_supplier_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_supplier_category;
	}
	
	public function getListRows($sql="select count(*) from t_supplier_category"){
		return $this->g_db->getRows($sql);
	}
	
	public function addSupplierCategory($supplier_category){
		date_default_timezone_set('PRC');
		$supplier_category_name=$supplier_category->_get('supplier_category_name');
		$created=date('Y-m-d H:i:s');		
		$sql=sprintf("insert into t_supplier_category (supplier_category_name,created) values ('%s','%s')",$supplier_category_name,$created);
		return $this->g_db->Execute($sql);
	}
	
	public function getSupplierCategoryById($id){
		$sql=sprintf("select * from t_supplier_category where id=%d",$id);
		return $this->g_db->getOne($sql);
	}
	
	public function updateSupplierCategory($supplier_category){		
		$id=$supplier_category->_get('id');
		$supplier_category_name=$supplier_category->_get('supplier_category_name');		
		$sql=sprintf("update t_supplier_category set supplier_category_name='%s' where id=%d",$supplier_category_name,$id);
		return $this->g_db->Execute($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_supplier_category where supplier_category_name like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by id desc";
		$array_supplier_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_supplier_category;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_supplier_category where supplier_category_name like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}

}