<?php
/*
 * @auther lion
 * @date 2013-2-4
 */
class OrderService{
	private $g_db;
	public function __construct(){
		require_once 'class/order.class.php';
		require_once 'class/supplier.class.php';
		require_once 'class/supplier_service.class.php';
		require_once 'class/order_goods.class.php';
		require_once './class/database.class.php';
		require_once 'class/goods_service.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_order"){

		$sql=$sql." order by id desc";
		$array_order=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		$supplier_service=new SupplierService();
		foreach ($array_order as $order){
			$supplier_id=$order->supplier_id;
			$supplier=$supplier_service->getSupplierById($supplier_id);
			$supplier_name=$supplier->supplier_name;
			$order->supplier_name=$supplier_name;
		}
		return $array_order;
	}
	public function getListRows($sql="select count(*) from t_order"){
		return $this->g_db->getRows($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select  *  from t_order,t_supplier where t_order.supplier_id=t_supplier.id and concat ( t_order.order_number,t_supplier.supplier_name,t_order.status ) like  "){
		$keywords=strtr($keywords,CodeNames::$order_status_search_replace);
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by t_order.id desc ";
		$array_order=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_order;
	}
	public  function getListRowsByKeywords($keywords,$sql="select  count(*)  from t_order,t_supplier where t_order.supplier_id=t_supplier.id and concat ( t_order.order_number,t_supplier.supplier_name,t_order.status ) like  "){
		$keywords=strtr($keywords,CodeNames::$order_status_search_replace);
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	
	public function addOrder($order){
		$order_number=$order->_get('order_number');
		$supplier_id=$order->_get('supplier_id');
		$status=$order->_get('status');
		$note=$order->_get('note');
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_order  (order_number,supplier_id,status,note,created)  values ('%s','%s','%s','%s','%s')",$order_number,$supplier_id,$status,$note,$created);
		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public function addGoodsInOrder($goods_id,$goods_number,$is_out_of_stock,$order_id){
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_order_goods  (order_id,goods_id,goods_number,is_out_of_stock,created)  values ('%s','%s',%d,%d,'%s')",$order_id,$goods_id,$goods_number,$is_out_of_stock,$created);
		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public function getOrderById($id){
		$sql=sprintf("select * from t_order where id=%d",$id);
		$order=$this->g_db->getOne($sql);
		$supplier_service=new SupplierService();
		$supplier_id=$order->supplier_id;
		$supplier=$supplier_service->getSupplierById($supplier_id);
		$supplier_name=$supplier->supplier_name;
		$order->supplier_name=$supplier_name;
		return $order;
	}
	public function getGoodsByOrderId($id){
		$sql="select * from t_order_goods,t_goods where order_id=%d and t_order_goods.goods_id=t_goods.id";
		$sql=sprintf($sql,$id);
		$array_order_goods=$this->g_db->getAllDate($sql);
		
		return $array_order_goods;
	}
	
	public function getGoodsByOrderIdSubPage($pageCurrent,$PageSize,$id){
		$sql="select * from t_order_goods,t_goods where order_id=%d and t_order_goods.goods_id=t_goods.id";
		$sql=sprintf($sql,$id);
		$array_order_goods=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_order_goods;
	}
	
	public function getGoodsByOrderIdCount($id){
		$sql="select count(*) from t_order_goods,t_goods where order_id=%d and t_order_goods.goods_id=t_goods.id";
		$sql=sprintf($sql,$id);
		return $this->g_db->getRows($sql);
	}
	
	public function updateOrder($order){
		print_r($order);
		$id=$order->_get('id');
		$order_number=$order->_get('order_number');
		$supplier_id=$order->_get('supplier_id');
		$status=$order->_get('status');
		$note=$order->_get('note');
		$sql=sprintf("update t_order  set order_number='%s',supplier_id= %d ,status='%s',note='%s'  where id=%d",$order_number,$supplier_id,$status,$note ,$id);
		return $this->g_db->Execute($sql);
	}
	
	public function updateGoodsInOrder($goods_id, $goods_number,$is_out_of_stock, $order_id){
		$sql="update t_order_goods set goods_number=%d , is_out_of_stock =%d where goods_id=%d and order_id=%d";
		$sql=sprintf($sql,$goods_number,$is_out_of_stock,$goods_id,$order_id);
		return $this->g_db->Execute($sql);
	}
	
}
?>