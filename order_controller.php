<?php 
/*
 * @auther lion
 * @date 2013-2-4
 */
require_once './class/log_service.class.php';
$log_service=new LogService();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './order_view_ls.php';
			break;
		case 'add_get':
			require_once './order_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/order_service.class.php';
			require_once 'class/order.class.php';
			require_once 'class/code_names.class.php';
			$order_number="dd".time();
			$supplier_id=$_POST['supplier_id'];
			$status=CodeNames::$order_status_pending_audit;
			$note=$_POST['note'];
			$goods_id=$_POST['goods_id'];
			$goods_number=$_POST['goods_number'];
			$order_service=new OrderService();
			$order=new Order(null, $order_number, $supplier_id, $status, $note);
			$order_id=$order_service->addOrder($order);
			$log_service->addLog("insert","订单",$id);
			
			foreach ($goods_id as $id=>$goods_id){
				$order_goods_id=$order_service->addGoodsInOrder($goods_id, $goods_number[$id],0, $order_id); 
				$log_service->addLog("insert","订单产品",$order_goods_id);
			}
			

			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加订单:".$order_number."成功";
			
			header("Location: ./index.php?mod=order&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/order_service.class.php';
			require_once './class/order.class.php';
			$order_service=new OrderService();
			$order=$order_service->getOrderById($id);
			$order=serialize($order);
			$_SESSION['order']=$order;
			require_once './order_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=order&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=order&action=ls");
			}
			break;
		case 'edit_post':
			$order_number=$_POST['order_number'];
			if(isset($_SESSION["id"])){
				require_once './class/order_service.class.php';
				require_once 'class/order.class.php';
				require_once 'class/order_goods.class.php';	
				$order_id=$_SESSION["id"];
				unset($_SESSION["id"]);
				
				$supplier_id=$_POST['supplier_id'];
				$status=$_POST['status'];
				$note=$_POST['note'];
				$order_service=new OrderService();
				$order=new Order($order_id, $order_number, $supplier_id, $status, $note);
				$order_service->updateOrder($order);
				
				$log_service->addLog("update","订单",$order_id);
				
				$goods_id=$_POST['goods_id'];
				print_r($goods_id);
				$goods_number=$_POST['goods_number'];
				$is_out_of_stock=$_POST['is_out_of_stock'];
				print_r($is_out_of_stock);
				foreach ($goods_id as $id=>$goods_id){
					if(in_array($goods_id, $is_out_of_stock)){
						$order_goods_id=$order_service->updateGoodsInOrder($goods_id, $goods_number[$id],1, $order_id);
						$log_service->addLog("update","订单产品",$order_goods_id);
					}
					else{
						
						$order_goods_id=$order_service->updateGoodsInOrder($goods_id, $goods_number[$id],0, $order_id);
						$log_service->addLog("update","订单产品",$order_goods_id);
					}
					
				}				
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改采购单:".$order_number."成功";	
				
				$log_service->addLog("update","采购单",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改采购单:".$order_number."失败";
				
			}
			header("Location: ./index.php?mod=order&action=ls");
			break;
		case 'detail':
			if(isset($_GET['did'])){
			$id=$_GET['did'];
			if(is_numeric($id)){
			require_once './class/order_service.class.php';
			require_once './class/order.class.php';
			$order_service=new OrderService();
			$order=$order_service->getOrderById($id);
			$order=serialize($order);
			$_SESSION['order']=$order;
			require_once './order_view_datail.php';
			}else{
				header("Location: ./index.php?mod=order&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=order&action=ls");
			}
			break;
		case 'detail_post':
			$order_id=$_POST['order_id'];
			if(isset($_POST['goods_id'])){
			$goods_id=$_POST['goods_id'];
			$goods_number=$_POST['goods_number'];
			print_r($goods_id);
			print_r($goods_number);
			require_once './class/order_service.class.php';
			$order_service=new OrderService();
			foreach ($goods_id as $id=>$goods_id){
				$order_goods_id=$order_service->addGoodsInOrder($goods_id, $goods_number[$id],0, $order_id);

				$log_service->addLog("insert","订单产品",$order_goods_id);
				header("Location: ./index.php?mod=order&action=detail&did=".$order_id);
			}			
			}else{
				header("Location: ./index.php?mod=order&action=detail&did=".$order_id);
			}		
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=order&action=ls");
}

?>