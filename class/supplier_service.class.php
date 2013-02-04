<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
class SupplierService{
	private $g_db;
	public function __construct(){
		require_once './class/supplier.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select t_supplier.*,t_supplier_category.supplier_category_name from t_supplier,t_supplier_category where t_supplier_category.id=t_supplier.supplier_category_id"){

		$sql=$sql." order by id desc";
		$array_supplier=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_supplier;
	}
	
	public function getListRows($sql="select count(*) from t_supplier"){
		return $this->g_db->getRows($sql);
	}
	
	public function addSupplier($supplier){
		date_default_timezone_set('PRC');
		$supplier_name=$supplier->_get('supplier_name');
		$supplier_category_id=$supplier->_get('supplier_category_id');
		$wholesale_num_min=$supplier->_get('wholesale_num_min');
		$wholesale_num_max=$supplier->_get('wholesale_num_max');
		$goods_style=$supplier->_get('goods_style');
		$goods_category=$supplier->_get('goods_category');
		$is_provide_pictures=$supplier->_get('is_provide_pictures');
		$website=$supplier->_get('website');
		$linkman=$supplier->_get('linkman');
		$telephone=$supplier->_get('telephone');
		$province=$supplier->_get('province');
		$city=$supplier->_get('city');
		$village=$supplier->_get('village');
		$address_detial=$supplier->_get('address_detial');
		$note=$supplier->_get('note');		
		$created=date('Y-m-d H:i:s');		
		$sql=sprintf("insert into  t_supplier (supplier_name,supplier_category_id,wholesale_num_min,wholesale_num_max,goods_style,goods_category,is_provide_pictures,website,linkman,telephone,province,city,village,address_detial,note,created) values ('%s','%d','%d','%d','%s','%s','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$supplier_name,$supplier_category_id,$wholesale_num_min,$wholesale_num_max,$goods_style,$goods_category,$is_provide_pictures,$website,$linkman,$telephone,$province,$city,$village,$address_detial,$note,$created);
		return $this->g_db->Execute($sql);
	}

	public function addGoods($id,$goods_id){
		date_default_timezone_set('PRC');
		$created=date('Y-m-d H:i:s');	
		foreach ($goods_id as $goodsID) {
			$sql=sprintf("insert into  t_supplier_rel_goods (supplier_id,goods_id,created) values ('%d','%d','%s')",$id,$goodsID,$created);
			$this->g_db->Execute($sql);
		}		
	}
	
	public function getSupplierById($id){
		$sql=sprintf("select t_supplier.*,t_supplier_category.supplier_category_name from t_supplier,t_supplier_category where t_supplier_category.id=t_supplier.supplier_category_id and t_supplier.id=%d",$id);
		return $this->g_db->getOne($sql);
	}
	
	public function updateSupplier($supplier){		
		$id=$supplier->_get('id');
		$supplier_name=$supplier->_get('supplier_name');
		$supplier_category_id=$supplier->_get('supplier_category_id');
		$wholesale_num_min=$supplier->_get('wholesale_num_min');
		$wholesale_num_max=$supplier->_get('wholesale_num_max');
		$goods_style=$supplier->_get('goods_style');
		$goods_category=$supplier->_get('goods_category');
		$is_provide_pictures=$supplier->_get('is_provide_pictures');
		$website=$supplier->_get('website');
		$linkman=$supplier->_get('linkman');
		$telephone=$supplier->_get('telephone');
		$province=$supplier->_get('province');
		$city=$supplier->_get('city');
		$village=$supplier->_get('village');
		$address_detial=$supplier->_get('address_detial');
		$note=$supplier->_get('note');				
		$sql=sprintf("update t_supplier set supplier_name='%s',supplier_category_id='%d',wholesale_num_min='%d',wholesale_num_max='%d',goods_style='%s',goods_category='%s',is_provide_pictures='%d',website='%s',linkman='%s',telephone='%s',province='%s',city='%s',village='%s',address_detial='%s',note='%s',created='%s' where id=%d",$supplier_name,$supplier_category_id,$wholesale_num_min,$wholesale_num_max,$goods_style,$goods_category,$is_provide_pictures,$website,$linkman,$telephone,$province,$city,$village,$address_detial,$note,$created,$id);
		return $this->g_db->Execute($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select t_supplier.*,t_supplier_category.supplier_category_name from t_supplier,t_supplier_category where t_supplier_category.id=t_supplier.supplier_category_id and supplier_name like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by id desc";
		$array_supplier=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_supplier;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_supplier where supplier_name like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	public function getAll($sql="select * from t_supplier "){
		return $this->g_db->getAllDate($sql);
	}

}