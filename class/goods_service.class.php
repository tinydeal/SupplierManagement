<?php
/*
 * @auther lion	
 * @date 2013-2-1
 */
class GoodsService{
	private $g_db;
	public function __construct(){
		require_once 'class/goods_category.class.php';
		require_once 'class/goods_category_service.class.php';
		require_once 'class/goods.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_goods"){

		$sql=$sql." order by id desc";
		$array_goods=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		$goods_category_service=new GoodsCategoryService();
		foreach ($array_goods as $goods){
			$goods_category_id=$goods->goods_category_id;
			$goods_category=$goods_category_service->getGoodsCategoryById($goods_category_id);
			$goods_category_name=$goods_category->goods_category_name;
			$goods->goods_category_name=$goods_category_name;
		}
		return $array_goods;
	}
	public function getListRows($sql="select count(*) from t_goods"){
		return $this->g_db->getRows($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select  *  from t_goods,t_goods_category where t_goods_category.id=t_goods.goods_category_id and concat ( t_goods.goods_name,t_goods_category.goods_category_name,t_goods.system_number,t_goods.price,t_goods.size,t_goods.color ) like  "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by t_goods.id desc ";
		$array_goods=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_goods;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*)  from t_goods,t_goods_category where t_goods_category.id=t_goods.goods_category_id and concat ( t_goods.goods_name,t_goods_category.goods_category_name,t_goods.system_number,t_goods.price,t_goods.size,t_goods.color ) like  "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	
	public function addGoods($goods){
		$goods_name=$goods->_get('goods_name');
		$goods_category_id=$goods->_get('goods_category_id');
		$system_number="sp".time();
		$price=$goods->_get('price');
		$size=$goods->_get('size');
		$color=$goods->_get('color');
		$description=$goods->_get('description');
		$website=$goods->_get('website');
		$note=$goods->_get('note');
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_goods  (goods_name,goods_category_id,price,size,color,description,website,note,created)  values ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",$goods_name,$goods_category_id,$price,$size,$color,$description,$website,$note,$created);
		

		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public function getGoodsById($id){
		$sql=sprintf("select * from t_goods where id=%d",$id);
		$goods=$this->g_db->getOne($sql);
		$goods_category_service=new GoodsCategoryService();
		$goods_category_id=$goods->goods_category_id;
		$goods_category=$goods_category_service->getGoodsCategoryById($goods_category_id);
		$goods_category_name=$goods_category->goods_category_name;
		$goods->goods_category_name=$goods_category_name;
		return $goods;
	}
	
	public function updateGoods($goods){
		$id=$goods->_get('id');
		$goods_name=$goods->_get('goods_name');
		$goods_category_id=$goods->_get('goods_category_id');
		$system_number=$goods->_get('system_number');
		$price=$goods->_get('price');
		$size=$goods->_get('size');
		$color=$goods->_get('color');
		$description=$goods->_get('description');
		$website=$goods->_get('website');
		$note=$goods->_get('note');
		$sql=sprintf("update t_goods  set goods_name='%s',goods_category_id='%s',system_number='%s',price='%s',size='%s',color='%s',description='%s',website='%s',note='%s' where id=%d",$goods_name,$goods_category_id,$system_number,$price,$size,$color,$description,$website,$note,$id);
		
		$oldPrice=$_SESSION['price'];
		if($price!=$oldPrice){
			$created=date('Y-m-d H:i:s');
			$price_sql=sprintf("insert into t_price_change (goods_id,price,created) values(%d,'%s','%s')",$id,$price,$created);
			$this->g_db->Execute($price_sql);
			$insert_id=$this->g_db->getLastId();
			require_once './class/log_service.class.php';
			$log_service=new LogService();
			$log_service->addLog("insert","价格变化",$insert_id);
		}
		return $this->g_db->Execute($sql);
	}
	  
	public function getGoodsBySupplierId($id){
		$sql="select t_goods.* from t_goods,t_supplier_rel_goods where t_goods.id=t_supplier_rel_goods.goods_id and t_supplier_rel_goods.supplier_id= %d";
		$sql=sprintf($sql,$id);
		$array_goods=$this->g_db->getAllDate($sql);
		return $array_goods;
	}
	public function getGoodsBySupplierIdNotInOrder($supplier_id,$order_id){
		$sql="select t_goods.* from t_goods,t_supplier_rel_goods where t_goods.id=t_supplier_rel_goods.goods_id and t_supplier_rel_goods.supplier_id= %d and goods_id not in(select goods_id from t_order_goods where order_id=%d )";
		$sql=sprintf($sql,$supplier_id,$order_id);
		$array_goods=$this->g_db->getAllDate($sql);
		return $array_goods;
	}	

	
}
?>