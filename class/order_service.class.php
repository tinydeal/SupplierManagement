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
		require_once './class/database.class.php';
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
		$array_goods=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_goods;
	}
	public  function getListRowsByKeywords($keywords,$sql="select  count(*)  from t_order,t_supplier where t_order.supplier_id=t_supplier.id and concat ( t_order.order_number,t_supplier.supplier_name,t_order.status ) like  "){
		$keywords=strtr($keywords,CodeNames::$order_status_search_replace);
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	
}
?>