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
			
			$order_name=$_POST['order_name']; 
			$order=new GoodsCategory(null,$order_name);
			$order_service=new GoodsCategoryService();
			$id=$order_service->addGoodsCategory($order);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加产品类别:".$order_name."成功";
			
			$log_service->addLog("insert","产品类别",$id);
			header("Location: ./index.php?mod=order&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/order_service.class.php';
			require_once 'class/order.class.php';
			$order_service=new GoodsCategoryService();
			$order=$order_service->getGoodsCategoryById($id);
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
			if(isset($_SESSION["id"])){
				require_once './class/order_service.class.php';
				require_once 'class/order.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$order_name=$_POST['order_name'];
				$order=new GoodsCategory($id,$order_name);
				$order_service=new GoodsCategoryService();
				$order_service->updateGoodsCategory($order);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改产品类别:".$order_name."成功";	
				
				$log_service->addLog("update","产品类别",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改产品类别:".$order_name."失败";
				
			}
			header("Location: ./index.php?mod=order&action=ls");
				
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=order&action=ls");
}

?>