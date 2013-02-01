<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
require_once './class/log_service.class.php';
$log_service=new LogService();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './supplier_view_ls.php';
			break;
		case 'add_get':
			require_once './supplier_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/supplier_service.class.php';
			require_once 'class/supplier.class.php';			
			
			$supplier_name=$_POST['supplier_name'];			
			$supplier_category_id=$_POST['supplier_category_id'];
			$wholesale_num_min=$_POST['wholesale_num_min'];
			$wholesale_num_max=$_POST['wholesale_num_max'];
			$goods_style=$_POST['goods_style'];
			$goods_category=$_POST['goods_category'];
			$is_provide_pictures=$_POST['is_provide_pictures'];
			$website=$_POST['website'];
			$linkman=$_POST['linkman'];
			$telephone=$_POST['telephone'];
			$province=$_POST['province'];
			$city=$_POST['city'];
			$village=$_POST['village'];
			$address_detial=$_POST['address_detial'];
			$note=$_POST['note'];					
			$supplier=new Supplier(null,$supplier_name,$supplier_category_id,$wholesale_num_min,$wholesale_num_max,$goods_style,$goods_category,$is_provide_pictures,$website,$linkman,$telephone,$province,$city,$village,$address_detial,$note);
			$supplier_service=new SupplierService();
			$supplier_service->addSupplier($supplier);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加供应商:".$supplier_name." 成功";
			$log_service->addLog("insert","供应商",null);
			header("Location: ./index.php?mod=supplier&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/supplier_service.class.php';
			require_once 'class/supplier.class.php';
			$supplier_service=new SupplierService();
			$supplier=$supplier_service->getSupplierById($id);
			$supplier=serialize($supplier);
			$_SESSION['supplier']=$supplier;
			require_once './supplier_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=supplier&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=supplier&action=ls");
			}
			break;
		case 'edit_post':
			if(isset($_SESSION["id"])){
				require_once './class/supplier_service.class.php';
				require_once 'class/supplier.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$supplier_name=$_POST['supplier_name'];			
				$supplier_category_id=$_POST['supplier_category_id'];
				$wholesale_num_min=$_POST['wholesale_num_min'];
				$wholesale_num_max=$_POST['wholesale_num_max'];
				$goods_style=$_POST['goods_style'];
				$goods_category=$_POST['goods_category'];
				$is_provide_pictures=$_POST['is_provide_pictures'];
				$website=$_POST['website'];
				$linkman=$_POST['linkman'];
				$telephone=$_POST['telephone'];
				$province=$_POST['province'];
				$city=$_POST['city'];
				$village=$_POST['village'];
				$address_detial=$_POST['address_detial'];
				$note=$_POST['note'];					
				$supplier=new Supplier($id,$supplier_name,$supplier_category_id,$wholesale_num_min,$wholesale_num_max,$goods_style,$goods_category,$is_provide_pictures,$website,$linkman,$telephone,$province,$city,$village,$address_detial,$note);
				$supplier_service=new SupplierService();
				$supplier_service->updateSupplier($supplier);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改供应商信息:".$supplier_name." 成功";	
				$log_service->addLog("update","供应商",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改供应商信息:".$supplier_name." 失败";
				
			}
			header("Location: ./index.php?mod=supplier&action=ls");
				
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=supplier&action=ls");
}
?>
