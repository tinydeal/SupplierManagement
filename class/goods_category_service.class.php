<?php
/*
 * @auther lion
 * @date 2013-2-1
 */
class GoodsCategoryService{
		private $g_db;
	public function __construct(){
		require_once 'class/goods_category.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_goods_category"){

		$sql=$sql." order by id desc";
		$array_goods_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_goods_category;
	}
	
	public function getListRows($sql="select count(*) from t_goods_category"){
		return $this->g_db->getRows($sql);
	}
	public function addGoodsCategory($goods_category){
		$goods_category_name=$goods_category->_get('goods_category_name');
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_goods_category  (goods_category_name,created)  values ('%s','%s')",$goods_category_name,$created);
		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_goods_category where concat (goods_category_name) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by id desc";
		$array_goods_category=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_goods_category;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_goods_category where concat (goods_category_name ) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	
	public function getGoodsCategoryById($id){
		$sql=sprintf("select * from t_goods_category where id=%d",$id);
		return $this->g_db->getOne($sql);
	}
	
	public function updateGoodsCategory($goods_category){
		$id=$goods_category->_get('id');
		$goods_category_name=$goods_category->_get('goods_category_name');
		$sql=sprintf("update t_goods_category set goods_category_name='%s' where id=%d",$goods_category_name,$id);
		return $this->g_db->Execute($sql);
	}
	
	
}
?>